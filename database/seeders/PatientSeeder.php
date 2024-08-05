<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PatientSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Patient::factory()
            ->count(100)
            ->create();
        // DB::table('patients')->insert([
        //     ['first_name' => 'Vincent', 'last_name' => 'Foltz', 'email' => 'john@example.com', 'gender' => 'F', 'birth_date' => '08/11/1999', 'country' => 'USA', 'created_at' => Carbon::now()],
        // ]);
    }
}
