<?php

declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tableName = config('email-change-confirmation.table_name', 'email_changes');
        $connection = config('email-change-confirmation.connection');

        if (! is_string($tableName)) {
            $tableName = 'email_changes';
        }

        if (! is_string($connection)) {
            $connection = null;
        }

        $userModel = config('email-change-confirmation.user_model', config('auth.providers.users.model'));

        if (! is_string($userModel) || ! is_subclass_of($userModel, Model::class)) {
            throw new RuntimeException('Invalid user model configured.');
        }

        $user = new $userModel;

        $userTable = $user->getTable();
        $userKeyType = $user->getKeyType();

        Schema::connection($connection)->create($tableName, function (Blueprint $table) use ($userTable, $userKeyType): void {
            $table->uuid('id')->primary();

            if ($userKeyType === 'int') {
                $table->unsignedBigInteger('user_id');
            } else {
                $table->uuid('user_id');
            }

            $table
                ->foreign('user_id')
                ->references('id')
                ->on($userTable)
                ->cascadeOnDelete();

            $table->string('current_email');
            $table->string('new_email');
            $table->timestamp('change_confirmed_at')->nullable();
            $table->timestamp('change_denied_at')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index(['user_id', 'created_at']);
            $table->index('change_confirmed_at');
            $table->index('change_denied_at');
        });
    }

    public function down(): void
    {
        $tableName = config('email-change-confirmation.table_name', 'email_changes');
        $connection = config('email-change-confirmation.connection');

        if (! is_string($tableName)) {
            $tableName = 'email_changes';
        }

        if (! is_string($connection)) {
            $connection = null;
        }

        Schema::connection($connection)->dropIfExists($tableName);
    }
};
