<?php

namespace Database\Seeders;

use App\Models\School;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $counter = 0;
        while ($counter < 10) {
            try {
                School::factory()->create();
                $counter++;
            } catch (Exception $e) {
                // Most likely encountered a conflict
                Log::error($e->getMessage());
            }
        }
    }
}
