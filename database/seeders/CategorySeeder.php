<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category; //this represents our categories table

class CategorySeeder extends Seeder
{

    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Sports',
                'created_at'  => NOW(),
                'updated_at'  => NOW()
            ],
            [
                'name'       => 'News',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'name'       => 'Blogging',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ];

        $this->category->insert($categories); //insert new categories
    }
}
