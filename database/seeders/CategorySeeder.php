<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $auto = Category::create(['name' => 'Auto']);
        $moto = Category::create(['name' => 'Moto']);
        $bike = Category::create(['name' => 'Cyklo']);
        $tractor = Category::create(['name' => 'Traktorove']);

        Category::create(['name' => 'Pneumatiky', 'parent_id' => $auto->id]);
        Category::create(['name' => 'Pneumatiky', 'parent_id' => $moto->id]);
        Category::create(['name' => 'Pneumatiky', 'parent_id' => $bike->id]);
        Category::create(['name' => 'Pneumatiky', 'parent_id' => $tractor->id]);
    }
}
