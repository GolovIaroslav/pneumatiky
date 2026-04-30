<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Seeder;

class ProductImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $letneAuto = array_map(fn ($i) => 'letne' . $i . '.jpg', range(1, 12));
        $zimneAuto = array_map(fn ($i) => 'zimne' . $i . '.jpg', range(1, 12));
        $celorocneAuto = array_map(fn ($i) => 'letne' . $i . '.jpg', range(13, 17));
        $bikeMain = array_map(fn ($i) => 'bike' . $i . '.jpg', range(1, 11));
        $motoMain = array_map(fn ($i) => 'moto' . $i . '.jpg', range(1, 11));
        $traktorMain = array_map(fn ($i) => 'traktor' . $i . '.jpg', range(1, 10));

        $bikeOrMotoDetail = ['bike_detail1.jpg', 'bike_detail2.jpg', 'bike_detail3.jpg', 'bike_detail4.jpg'];
        $autoOrTractorDetail = ['letne_detail1.jpg', 'letne_detail2.jpg', 'letne_detail3.jpg', 'letne_detail4.jpg'];

        ProductImage::query()->delete();

        $products = Product::with('category.parent')->orderBy('id')->get();

        $autoLetne = [];
        $autoZimne = [];
        $autoCelorocne = [];
        $bikeProducts = [];
        $motoProducts = [];
        $traktorProducts = [];

        foreach ($products as $product) {
            $parentName = strtolower((string) optional($product->category->parent)->name);
            $season = strtolower((string) $product->season);

            if ($parentName === 'auto') {
                if ($season === 'zimne') {
                    $autoZimne[] = $product;
                } elseif ($season === 'celorocne') {
                    $autoCelorocne[] = $product;
                } else {
                    $autoLetne[] = $product;
                }
            } elseif ($parentName === 'cyklo') {
                $bikeProducts[] = $product;
            } elseif ($parentName === 'moto') {
                $motoProducts[] = $product;
            } elseif ($parentName === 'traktorove') {
                $traktorProducts[] = $product;
            }
        }

        // Use the newest seeded products per group so mapping remains stable after reseeds.
        $autoLetne = collect($autoLetne)->sortByDesc('id')->take(12)->sortBy('id')->values()->all();
        $autoZimne = collect($autoZimne)->sortByDesc('id')->take(12)->sortBy('id')->values()->all();
        $autoCelorocne = collect($autoCelorocne)->sortByDesc('id')->take(5)->sortBy('id')->values()->all();
        $bikeProducts = collect($bikeProducts)->sortByDesc('id')->take(11)->sortBy('id')->values()->all();
        $motoProducts = collect($motoProducts)->sortByDesc('id')->take(11)->sortBy('id')->values()->all();
        $traktorProducts = collect($traktorProducts)->sortByDesc('id')->take(10)->sortBy('id')->values()->all();

        $assignMainImages = function (array $items, array $images, array $detailImages): void {
            $limit = min(count($items), count($images));

            for ($i = 0; $i < $limit; $i++) {
                ProductImage::create([
                    'product_id' => $items[$i]->id,
                    'image_path' => 'images/products/' . $images[$i],
                    'is_main' => true,
                ]);

                foreach ($detailImages as $detailImage) {
                    ProductImage::create([
                        'product_id' => $items[$i]->id,
                        'image_path' => 'images/products/' . $detailImage,
                        'is_main' => false,
                    ]);
                }
            }
        };

        $assignMainImages($autoLetne, $letneAuto, $autoOrTractorDetail);
        $assignMainImages($autoZimne, $zimneAuto, $autoOrTractorDetail);
        $assignMainImages($autoCelorocne, $celorocneAuto, $autoOrTractorDetail);
        $assignMainImages($bikeProducts, $bikeMain, $bikeOrMotoDetail);
        $assignMainImages($motoProducts, $motoMain, $bikeOrMotoDetail);
        $assignMainImages($traktorProducts, $traktorMain, $autoOrTractorDetail);
    }
}
