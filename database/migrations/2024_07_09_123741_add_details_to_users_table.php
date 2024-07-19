<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add only the columns you need
            $table->string('firstname')->nullable()->after('email');
            $table->string('lastname')->nullable()->after('firstname');
            $table->string('address')->nullable()->after('lastname');
            $table->string('gender')->nullable()->after('address');
            $table->string('phone')->unique()->nullable()->after('gender');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['firstname', 'lastname', 'address', 'gender', 'phone']);
        });
    }
}
