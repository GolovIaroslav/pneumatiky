<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $autoPneus = Category::where('name', 'Pneumatiky')
            ->whereHas('parent', fn ($q) => $q->where('name', 'Auto'))
            ->firstOrFail();

        $motoPneus = Category::where('name', 'Pneumatiky')
            ->whereHas('parent', fn ($q) => $q->where('name', 'Moto'))
            ->firstOrFail();

        $bikePneus = Category::where('name', 'Pneumatiky')
            ->whereHas('parent', fn ($q) => $q->where('name', 'Cyklo'))
            ->firstOrFail();

        $tractorPneus = Category::where('name', 'Pneumatiky')
            ->whereHas('parent', fn ($q) => $q->where('name', 'Traktorove'))
            ->firstOrFail();

        $catalog = [
            $autoPneus->id => [
                ['Veltrix', 'Sunpath A1', 'letne', false, 205, 55, 'R16', 58.90, 25],
                ['Arqon', 'Helia Pro', 'letne', false, 225, 45, 'R17', 114.90, 13],
                ['Cryon', 'Icegrid N7', 'zimne', false, 205, 55, 'R16', 129.50, 9],
                ['Teronix', 'Clawline S', 'zimne', true, 215, 60, 'R16', 139.00, 7],
                ['Veltrix', 'Swiftlane', 'letne', false, 245, 40, 'R18', 173.00, 11],
                ['Arqon', 'Alltrail 4S', 'celorocne', false, 195, 65, 'R15', 91.40, 20],
                ['Cryon', 'Trackflow', 'letne', false, 235, 45, 'R18', 101.20, 15],
                ['Teronix', 'Coldmark X', 'zimne', false, 195, 65, 'R15', 99.90, 14],
                ['Veltrix', 'Driftline', 'letne', false, 215, 55, 'R17', 77.90, 16],
                ['Arqon', 'Pulse 9', 'zimne', false, 225, 50, 'R17', 121.80, 10],
            ],
            $motoPneus->id => [
                ['Cryon', 'Streetbite M1', 'letne', false, 120, 70, 'R17', 84.90, 18],
                ['Teronix', 'Apexrun M2', 'letne', false, 160, 60, 'R17', 96.50, 14],
                ['Arqon', 'Raincut M3', 'zimne', false, 180, 55, 'R17', 109.00, 9],
                ['Veltrix', 'Trailhook M4', 'celorocne', false, 150, 70, 'R17', 92.30, 12],
            ],
            $bikePneus->id => [
                ['Veltrix', 'Gripnest B1', 'letne', false, 40, 0, 'R26', 19.90, 40],
                ['Arqon', 'Urbanroll B2', 'letne', false, 35, 0, 'R28', 17.50, 34],
                ['Cryon', 'Trailmesh B3', 'celorocne', false, 45, 0, 'R27.5', 24.90, 30],
                ['Teronix', 'Snowloop B4', 'zimne', true, 42, 0, 'R27.5', 29.90, 20],
                ['Veltrix', 'Cityfoam B5', 'letne', false, 32, 0, 'R28', 16.20, 27],
                ['Arqon', 'Dirtcurl B6', 'celorocne', false, 50, 0, 'R29', 27.40, 19],
            ],
            $tractorPneus->id => [
                ['Teronix', 'Fieldtorq T1', 'celorocne', false, 320, 70, 'R24', 219.90, 8],
                ['Cryon', 'Furrowmax T2', 'celorocne', false, 340, 65, 'R28', 246.00, 6],
                ['Arqon', 'Soilmaster T3', 'celorocne', false, 360, 70, 'R30', 271.50, 5],
                ['Veltrix', 'Loadline T4', 'celorocne', false, 300, 80, 'R24', 204.20, 9],
            ],
        ];

        foreach ($catalog as $categoryId => $rows) {
            foreach ($rows as $row) {
                Product::create([
                    'category_id' => $categoryId,
                    'brand' => $row[0],
                    'name' => $row[1],
                    'description' => 'Demo popis produktu pre katalog a detail produktu.',
                    'season' => $row[2],
                    'has_spikes' => $row[3],
                    'width' => $row[4],
                    'profile' => $row[5],
                    'diameter' => $row[6],
                    'price' => $row[7],
                    'stock' => $row[8],
                ]);
            }
        }
    }
}
