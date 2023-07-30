<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Café Americano',
                'reference' => 'CAF001',
                'price' => 100,
                'weight' => 200,
                'stock' => 50,
                'category_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Café Latte',
                'reference' => 'CAF002',
                'price' => 120,
                'weight' => 250,
                'stock' => 40,
                'category_id' => 1,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Té Negro',
                'reference' => 'TE001',
                'price' => 80,
                'weight' => 100,
                'stock' => 30,
                'category_id' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Té Verde',
                'reference' => 'TE002',
                'price' => 90,
                'weight' => 120,
                'stock' => 35,
                'category_id' => 2,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Refresco de Limón',
                'reference' => 'REF001',
                'price' => 70,
                'weight' => 300,
                'stock' => 20,
                'category_id' => 3,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Bocadillo de Jamón y Queso',
                'reference' => 'BOC001',
                'price' => 150,
                'weight' => 180,
                'stock' => 25,
                'category_id' => 4,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Brownie de Chocolate',
                'reference' => 'BRO001',
                'price' => 130,
                'weight' => 120,
                'stock' => 15,
                'category_id' => 5,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Cuchara de café',
                'reference' => 'UTC001',
                'price' => 10,
                'weight' => 50,
                'stock' => 100,
                'category_id' => 6,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Vaso desechable',
                'reference' => 'UTC002',
                'price' => 5,
                'weight' => 30,
                'stock' => 200,
                'category_id' => 6,
                'created_by' => 1,
                'updated_by' => 1,
            ],
            [
                'name' => 'Tenedor de café',
                'reference' => 'UTC003',
                'price' => 15,
                'weight' => 80,
                'stock' => 80,
                'category_id' => 6,
                'created_by' => 1,
                'updated_by' => 1,
            ],
        ];

        Product::insert($products);
    }
}
