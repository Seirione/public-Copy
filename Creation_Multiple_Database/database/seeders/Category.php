<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SubCategoryModel;
use Illuminate\Support\Facades\DB;
use Throwable;

class Category extends Seeder
{
    protected int $number_max = 1000;

    public function run(): void
    {
        for ($i = 0; $i < $this->number_max; $i++) {
            try {
                DB::transaction(function () {
                    $sub = new SubCategoryModel();
                    
                    // Assign the fake words to your actual database column name
                    // Replace 'name' with your actual sub-category name column
                    $sub->Category = fake()->words(3, true); 
                    
                    $sub->save();
                });
            } catch (Throwable $e) {
                $this->command->error('Category ' . ($i + 1) . ' failed: ' . $e->getMessage());
            }
        }

        $this->command->info('Category seeding completed.');
    }
}
