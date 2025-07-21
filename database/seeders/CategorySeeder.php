<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Housing',
            'Transportation',
            'Food',
            'Utilities',
            'Insurance',
            'Medical & Healthcare',
            'Saving, Investing, & Debt Payments',
            'Personal Spending',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}

