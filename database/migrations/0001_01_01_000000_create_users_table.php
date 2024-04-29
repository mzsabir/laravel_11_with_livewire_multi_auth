<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role')->default('client');
            $table->string('phone')->default('');
            $table->string('cnic')->default('');
            $table->string('city')->default('');
            $table->string('registration')->nullable();
            $table->string('area')->nullable();
            $table->string('picture')->default('profile-img.jpg');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        Schema::create('policecases', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('act');           
            $table->string('slug');
            $table->string('detail',100)->default('Explain your case');
            $table->string('client_id');
            $table->string('lawyer_id')->default(0);
            $table->string('status')->default("pending");
            $table->integer('rating')->default(0);
            $table->string('comments')->nullable()->default("");
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        Schema::create('hearings', function (Blueprint $table) {
            $table->id();
            $table->integer('case_id');
            $table->string('court');   
            $table->string('judge');
            $table->string('city')->default('Islamabad');
            $table->string('comment');
            $table->longText('result');
            $table->date('hearing_date');
            $table->date('next_date');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('slug', 100)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('file', 100);
            $table->integer('uploaded_by');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });   

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title',100);
            $table->string('contents', 100);
            $table->string('image', 100);
            $table->integer('author_id');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });   

        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->datetime('time')->nullable();
            $table->string('subject');
            $table->string('message');
            $table->integer('client_id');
            $table->integer('lawyer_id');
            $table->string('status')->nullable()->default('pending');
            $table->string('detail')->nullable()->default('');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });   

        // By laravel
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
