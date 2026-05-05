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
        Product::query()->delete();

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
                // 12x letne auto
                ['Veltrix', 'Sunpath A1', 'letne', false, 205, 55, 'R16', 58.90, 25],
                ['Arqon', 'Helia Pro', 'letne', false, 225, 45, 'R17', 114.90, 13],
                ['Cryon', 'Trackflow RS', 'letne', false, 235, 45, 'R18', 101.20, 15],
                ['Teronix', 'Driftline X', 'letne', false, 215, 55, 'R17', 77.90, 16],
                ['Veltrix', 'Swiftlane GT', 'letne', false, 245, 40, 'R18', 173.00, 11],
                ['Arqon', 'Roadcrest V2', 'letne', false, 195, 65, 'R15', 72.40, 22],
                ['Cryon', 'Asphalt Edge', 'letne', false, 225, 50, 'R17', 109.30, 14],
                ['Teronix', 'Velocity Prime', 'letne', false, 205, 60, 'R16', 83.70, 19],
                ['Veltrix', 'Heatline Sport', 'letne', false, 235, 40, 'R19', 186.50, 9],
                ['Arqon', 'Tarmac Echo', 'letne', false, 215, 50, 'R17', 94.10, 17],
                ['Cryon', 'Drygrip One', 'letne', false, 195, 55, 'R16', 69.90, 21],
                ['Teronix', 'Fasttrail S', 'letne', false, 225, 45, 'R18', 128.60, 12],

                // 12x zimne auto
                ['Veltrix', 'Frostpeak N1', 'zimne', false, 205, 55, 'R16', 96.80, 18],
                ['Arqon', 'Icegrid N7', 'zimne', false, 205, 55, 'R16', 129.50, 9],
                ['Cryon', 'Snowguard X', 'zimne', false, 195, 65, 'R15', 99.90, 14],
                ['Teronix', 'Clawline S', 'zimne', true, 215, 60, 'R16', 139.00, 7],
                ['Veltrix', 'Nordline Pro', 'zimne', false, 225, 50, 'R17', 121.80, 10],
                ['Arqon', 'Blizzard Run', 'zimne', false, 235, 45, 'R18', 148.90, 8],
                ['Cryon', 'Winterlock Z', 'zimne', false, 215, 55, 'R17', 116.40, 11],
                ['Teronix', 'Coldtrace V', 'zimne', false, 205, 60, 'R16', 104.20, 13],
                ['Veltrix', 'Icecraft W', 'zimne', false, 225, 45, 'R17', 118.70, 12],
                ['Arqon', 'Snowlane 4D', 'zimne', false, 195, 65, 'R16', 92.50, 16],
                ['Cryon', 'Frostline T', 'zimne', false, 215, 50, 'R17', 110.90, 11],
                ['Teronix', 'Nordice Max', 'zimne', false, 235, 45, 'R18', 154.30, 7],

                // 5x celorocne auto
                ['Veltrix', 'Alltrail 4S', 'celorocne', false, 195, 65, 'R15', 91.40, 20],
                ['Arqon', 'Crossseason M', 'celorocne', false, 205, 55, 'R16', 98.60, 17],
                ['Cryon', 'Yearway Plus', 'celorocne', false, 215, 55, 'R17', 112.20, 12],
                ['Teronix', 'Omnigrip A', 'celorocne', false, 225, 45, 'R17', 119.00, 10],
                ['Veltrix', 'Seasonline C', 'celorocne', false, 195, 60, 'R16', 94.70, 15],
            ],

            // 11x moto
            $motoPneus->id => [
                ['Veltrix', 'Streetbite M1', 'letne', false, 120, 70, 'R17', 84.90, 18],
                ['Arqon', 'Apexrun M2', 'letne', false, 160, 60, 'R17', 96.50, 14],
                ['Cryon', 'Raincut M3', 'zimne', false, 180, 55, 'R17', 109.00, 9],
                ['Teronix', 'Trailhook M4', 'celorocne', false, 150, 70, 'R17', 92.30, 12],
                ['Veltrix', 'Roadpulse M5', 'letne', false, 190, 50, 'R17', 118.40, 8],
                ['Arqon', 'Quicklean M6', 'zimne', false, 110, 80, 'R18', 76.90, 16],
                ['Cryon', 'Stormgrip M7', 'letne', false, 170, 60, 'R17', 102.60, 11],
                ['Teronix', 'Urbanline M8', 'celorocne', false, 140, 70, 'R17', 88.70, 13],
                ['Veltrix', 'Cornershift M9', 'letne', false, 180, 55, 'R18', 121.50, 9],
                ['Arqon', 'Raceform M10', 'zimne', false, 120, 70, 'R17', 93.40, 15],
                ['Cryon', 'Longride M11', 'celorocne', false, 160, 60, 'R17', 99.90, 12],
            ],

            // 11x cyklo
            $bikePneus->id => [
                ['Veltrix', 'Gripnest B1', 'letne', false, 40, 0, 'R26', 19.90, 40],
                ['Arqon', 'Urbanroll B2', 'letne', false, 35, 0, 'R28', 17.50, 34],
                ['Cryon', 'Trailmesh B3', 'celorocne', false, 45, 0, 'R27.5', 24.90, 30],
                ['Teronix', 'Snowloop B4', 'zimne', true, 42, 0, 'R27.5', 29.90, 20],
                ['Veltrix', 'Cityfoam B5', 'letne', false, 32, 0, 'R28', 16.20, 27],
                ['Arqon', 'Dirtcurl B6', 'celorocne', false, 50, 0, 'R29', 27.40, 19],
                ['Cryon', 'Trailpeak B7', 'letne', false, 47, 0, 'R29', 26.10, 23],
                ['Teronix', 'Commuter B8', 'letne', false, 38, 0, 'R28', 18.60, 31],
                ['Veltrix', 'Mudline B9', 'celorocne', false, 52, 0, 'R27.5', 28.90, 17],
                ['Arqon', 'Roadzip B10', 'letne', false, 30, 0, 'R28', 15.80, 36],
                ['Cryon', 'Forestgrip B11', 'celorocne', false, 48, 0, 'R29', 27.90, 21],
            ],

            // 10x traktor
            $tractorPneus->id => [
                ['Teronix', 'Fieldtorq T1', 'celorocne', false, 320, 70, 'R24', 219.90, 8],
                ['Cryon', 'Furrowmax T2', 'celorocne', false, 340, 65, 'R28', 246.00, 6],
                ['Arqon', 'Soilmaster T3', 'celorocne', false, 360, 70, 'R30', 271.50, 5],
                ['Veltrix', 'Loadline T4', 'celorocne', false, 300, 80, 'R24', 204.20, 9],
                ['Teronix', 'Agroline T5', 'celorocne', false, 380, 70, 'R30', 286.40, 4],
                ['Cryon', 'Plowgrip T6', 'celorocne', false, 320, 85, 'R24', 233.70, 7],
                ['Arqon', 'Harvestor T7', 'celorocne', false, 340, 70, 'R28', 254.90, 6],
                ['Veltrix', 'Farmtrail T8', 'celorocne', false, 300, 70, 'R24', 211.30, 8],
                ['Teronix', 'Loadcrest T9', 'celorocne', false, 360, 65, 'R30', 279.20, 5],
                ['Cryon', 'Terrahook T10', 'celorocne', false, 320, 70, 'R28', 241.80, 6],
            ],
        ];

        foreach ($catalog as $categoryId => $rows) {
            foreach ($rows as $row) {
                Product::create([
                    'category_id' => $categoryId,
                    'brand' => $row[0],
                    'name' => $row[1],
                    'description' => 'Demo popis produktu pre katalóg a detail produktu.',
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
