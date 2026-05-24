<?php

declare(strict_types=1);

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HasQueryFiltersTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_exact_starts_with(): void
    {
        User::factory()->create(['name' => 'John Doe', 'email' => 'john@example.test']);
        User::factory()->create(['name' => 'Joanna Smith', 'email' => 'joanna@example.test']);
        User::factory()->create(['name' => 'Major Tom', 'email' => 'major@example.test']);

        $results = User::query()->searchExact(null, 'Jo')->get();

        $this->assertCount(2, $results);
        $this->assertTrue($results->contains('name', 'John Doe'));
        $this->assertTrue($results->contains('name', 'Joanna Smith'));
        $this->assertFalse($results->contains('name', 'Major Tom'));
    }

    public function test_search_loose_contains(): void
    {
        User::factory()->create(['name' => 'Alice Johnson', 'email' => 'alice@example.test']);
        User::factory()->create(['name' => 'Bob Major', 'email' => 'bob@example.test']);
        User::factory()->create(['name' => 'Carol', 'email' => 'carol@example.test']);

        $results = User::query()->searchLoose(null, 'jor')->get();

        $this->assertCount(1, $results);
        $this->assertTrue($results->contains('name', 'Bob Major'));
    }

    public function test_fields_whitelist_is_applied(): void
    {
        // Only name and email are allowed in the model's $searchable list
        User::factory()->create(['name' => 'Search Me', 'email' => 'search@example.test']);

        // Attempt to search on a non-whitelisted field (e.g. password) — should be ignored
        $results = User::query()->searchLoose(['password'], 'Search')->get();

        // No fields matched, so trait returns the unmodified query -> results should be all users (1)
        $this->assertCount(1, $results);
    }

    public function test_search_exact_can_search_specific_allowed_field(): void
    {
        User::factory()->create(['name' => 'John Doe', 'email' => 'admin@example.test']);
        User::factory()->create(['name' => 'Admin User', 'email' => 'john@example.test']);

        $results = User::query()->searchExact(['email'], 'john')->get();

        $this->assertCount(1, $results);
        $this->assertTrue($results->contains('email', 'john@example.test'));
        $this->assertFalse($results->contains('name', 'John Doe'));
    }

    public function test_search_loose_can_search_email(): void
    {
        User::factory()->create(['name' => 'Alice', 'email' => 'alice@example.test']);
        User::factory()->create(['name' => 'Bob', 'email' => 'bob@company.test']);

        $results = User::query()->searchLoose(null, 'company')->get();

        $this->assertCount(1, $results);
        $this->assertTrue($results->contains('email', 'bob@company.test'));
    }
}
