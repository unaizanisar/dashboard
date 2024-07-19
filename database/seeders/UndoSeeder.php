<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UndoSeeder extends Seeder
{
    public function run()
    {
        // Delete records inserted by the original seeder
        DB::table('roles')->whereIn('name', ['admin', 'blogger'])->delete();
    }
}
