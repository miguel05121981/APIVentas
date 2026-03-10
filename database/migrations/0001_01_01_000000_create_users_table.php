<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('licenses', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('amount', 10, 2);
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'expired'])->default('active');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('address', 100)->nullable();
            $table->string('phone', 20)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreignId('licenses_id')->constrained('licenses');
        });

        Schema::create('rols', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->boolean('active')->default(true);
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('rol_id')->constrained('rols')->onDelete('cascade');
            $table->foreignId('user_create')->nullable()->constrained('users');
            $table->foreignId('user_update')->nullable()->constrained('users');
        });

        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('segment', 100);
            $table->string('name', 100);
            $table->integer('orden');
            $table->foreignId('parent_id')->nullable()->constrained('menus')->onDelete('cascade');
            $table->foreignId('user_create')->nullable()->constrained('users');
            $table->foreignId('user_update')->nullable()->constrained('users');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->nullable()->constrained('menus')->onDelete('cascade');
            $table->enum('action', ['view', 'create', 'update', 'delete', 'read', 'custom']);
            $table->foreignId('user_create')->nullable()->constrained('users');
            $table->foreignId('user_update')->nullable()->constrained('users');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('permission_rol', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rol_id')->constrained('rols')->onDelete('cascade');
            $table->foreignId('permission_id')->constrained('permissions')->onDelete('cascade');
            $table->foreignId('user_create')->nullable()->constrained('users');
            $table->foreignId('user_update')->nullable()->constrained('users');
            $table->timestamps();

            $table->unique(['rol_id', 'permission_id']);
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_rol');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('menus');

        Schema::dropIfExists('users');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('licenses');
        Schema::dropIfExists('rols');

        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
