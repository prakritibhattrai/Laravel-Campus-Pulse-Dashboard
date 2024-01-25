<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->nullable();
            $table->string('site_url')->nullable();
            $table->text('site_title')->nullable();
            $table->string('copyright')->nullable();
            $table->string('email')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('address')->nullable();
            $table->string('mail_driver')->nullable();
            $table->string('mail_host')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_from')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->boolean('cache')->default(0);
            $table->boolean('minify')->default(0);
            $table->boolean('use_ssl')->default(0);
            $table->boolean('app_debug')->default(0);
            $table->boolean('maintenance')->default(0);
            $table->boolean('google_recaptcha')->default(0);
            $table->string('timezone')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
