<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('references')->insert([
            'id' => 1,
            'code' => 'overtime_method',
            'name' => 'salary / 173',
            'expression' => '(salary / 173) * overtime_duration_total',
        ]);

        DB::table('references')->insert([
            'id' => 2,
            'code' => 'overtime_method',
            'name' => 'fixed',
            'expression' => '10000 * overtime_duration_total',
        ]);

        DB::table('references')->insert([
            'id' => 3,
            'code' => 'employee_status',
            'name' => 'tetap',
            'expression' => null,
        ]);

        DB::table('references')->insert([
            'id' => 4,
            'code' => 'employee_status',
            'name' => 'percobaan',
            'expression' => null,
        ]);
    }
}
