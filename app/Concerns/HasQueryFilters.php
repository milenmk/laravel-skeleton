<?php

declare(strict_types=1);

namespace App\Concerns;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

/**
 * @template TModel of Model
 */
trait HasQueryFilters
{
    /**
     * Scope for search: results start with (left-anchored / starts-with).
     *
     * @param array<int,string>|null $fields list of columns to search; when null the model's $searchable will be used
     * @param bool $caseInsensitive whether to perform a case-insensitive match (driver-specific)
     * @param bool $wholeWord whether to match whole words (DB-specific; less index-friendly)
     * @param Builder<TModel> $query
     * @return Builder<TModel>
     */
    public function scopeSearchExact(
        Builder $query,
        ?array $fields,
        string $search,
        bool $caseInsensitive = false,
        bool $wholeWord = false,
    ): Builder {
        /** @var Builder<TModel> $query */
        $fields = $this->resolveSearchableFields($query, $fields);
        if (empty($fields)) {
            return $query;
        }

        $grammar = $query->getQuery()->getGrammar();

        /** @var Connection $connection */
        $connection = $query->getConnection();
        $driver = $connection->getDriverName();

        return $query->where(function ($q) use ($fields, $search, $grammar, $driver, $caseInsensitive, $wholeWord): void {
            foreach ($fields as $field) {
                $wrapped = $grammar->wrap($field);

                if ($wholeWord) {
                    if ($driver === 'pgsql') {
                        $pattern = '\\m' . addcslashes($search, '\\') . '\\M';
                        /** @phpstan-ignore-next-line argument.type */
                        $q->orWhereRaw($wrapped . ' ~* ?', [$pattern]);
                    } else {
                        $pattern = '[[:<:]]' . preg_quote($search, '/') . '[[:>:]]';
                        /** @phpstan-ignore-next-line argument.type */
                        $q->orWhereRaw($wrapped . ' REGEXP ?', [$pattern]);
                    }

                    continue;
                }

                if ($caseInsensitive) {
                    if ($driver === 'pgsql') {
                        $q->orWhere($field, 'ILIKE', "$search%");
                    } else {
                        // Portable approach: LOWER(column) LIKE LOWER(?). Use bindings for safety.
                        /** @phpstan-ignore-next-line argument.type */
                        $q->orWhereRaw('LOWER(' . $wrapped . ') LIKE ?', [mb_strtolower($search) . '%']);
                    }
                } else {
                    $q->orWhere($field, 'like', "$search%");
                }
            }
        });
    }

    /**
     * Resolve and whitelist searchable fields.
     * Accepts a nullable $fields argument; when null or empty the model's
     * $searchable (static or instance) will be used. The result is the
     * intersection of requested fields and the model's whitelist.
     *
     * @param Builder<TModel> $query
     * @param array<int, string>|null $fields
     * @return list<string>
     */
    protected function resolveSearchableFields(Builder $query, ?array $fields): array
    {
        $model = $query->getModel();

        $modelSearchable = [];

        $reflection = new ReflectionClass($model);

        if ($reflection->hasProperty('searchable')) {
            $property = $reflection->getProperty('searchable');

            if ($property->isStatic()) {
                $value = $property->getValue();

                if (is_array($value)) {
                    $modelSearchable = array_values(array_filter(
                        $value,
                        static fn (mixed $item): bool => is_string($item),
                    ));
                }
            }
        }

        if ($fields === null || $fields === []) {
            return $modelSearchable;
        }

        return array_values(array_intersect($fields, $modelSearchable));
    }

    /**
     * Scope for search: results contain (anywhere in the column).
     *
     * @param array<int,string>|null $fields
     * @param Builder<TModel> $query
     * @return Builder<TModel>
     */
    public function scopeSearchLoose(
        Builder $query,
        ?array $fields,
        string $search,
        bool $caseInsensitive = false,
        bool $wholeWord = false
    ): Builder {
        /** @var Builder<TModel> $query */
        $fields = $this->resolveSearchableFields($query, $fields);
        if (empty($fields)) {
            return $query;
        }

        $grammar = $query->getQuery()->getGrammar();

        /** @var Connection $connection */
        $connection = $query->getConnection();
        $driver = $connection->getDriverName();

        return $query->where(function ($q) use ($fields, $search, $grammar, $driver, $caseInsensitive, $wholeWord): void {
            foreach ($fields as $field) {
                $wrapped = $grammar->wrap($field);

                if ($wholeWord) {
                    if ($driver === 'pgsql') {
                        $pattern = '\\m' . addcslashes($search, '\\') . '\\M';
                        /** @phpstan-ignore-next-line argument.type */
                        $q->orWhereRaw($wrapped . ' ~* ?', [$pattern]);
                    } else {
                        $pattern = '[[:<:]]' . preg_quote($search, '/') . '[[:>:]]';
                        /** @phpstan-ignore-next-line argument.type */
                        $q->orWhereRaw($wrapped . ' REGEXP ?', [$pattern]);
                    }

                    continue;
                }

                if ($caseInsensitive) {
                    if ($driver === 'pgsql') {
                        $q->orWhere($field, 'ILIKE', "%$search%");
                    } else {
                        /** @phpstan-ignore-next-line argument.type */
                        $q->orWhereRaw('LOWER(' . $wrapped . ') LIKE ?', ['%' . mb_strtolower($search) . '%']);
                    }
                } else {
                    $q->orWhere($field, 'like', "%$search%");
                }
            }
        });
    }

    /**
     * Scope for boolean fields.
     *
     * @param Builder<TModel> $query
     * @return Builder<TModel>
     */
    public function scopeWithBool(
        Builder $query,
        string $field,
        bool $value
    ): Builder {
        return $query->where($field, $value);
    }
}
