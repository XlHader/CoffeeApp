<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            ['name' => 'Café', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Té', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Bebidas frías', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Bocadillos', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Postres', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1, 'updated_by' => 1],
            ['name' => 'Utensilios', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now(), 'created_by' => 1, 'updated_by' => 1],
        ];

        Category::insert($categorias);
    }
}
