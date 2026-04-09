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
        $bikeMain = [
            'bike1.jpg', 'bike2.jpg', 'bike3.jpg', 'bike4.jpg', 'bike5.jpg', 'bike6.jpg', 'bike7.jpg',
        ];
        $letneMain = [
            'letne1.jpg', 'letne2.jpg', 'letne3.jpg', 'letne4.jpg', 'letne5.jpg', 'letne6.jpg', 'letne7.jpg',
            'letne8.jpg', 'letne9.jpg', 'letne10.jpg', 'letne11.jpg', 'letne12.jpg', 'letne13.jpg', 'letne14.jpg',
            'letne15.jpg', 'letne16.jpg', 'letne17.jpg',
        ];
        $zimneMain = [
            'zimne1.jpg', 'zimne2.jpg', 'zimne3.jpg', 'zimne4.jpg', 'zimne5.jpg', 'zimne6.jpg', 'zimne7.jpg', 'zimne8.jpg', 'zimne9.jpg', 'zimne10.jpg',
        ];
        $motoMain = ['moto1.jpg'];
        $traktorMain = ['traktor1.jpg', 'traktor2.jpg', 'traktor3.jpg', 'traktor4.jpg'];

        $bikeOrMotoDetail = ['bike_detail1.jpg', 'bike_detail2.jpg', 'bike_detail3.jpg', 'bike_detail4.jpg'];
        $autoOrTractorDetail = ['letne_detail1.jpg', 'letne_detail2.jpg', 'letne_detail3.jpg', 'letne_detail4.jpg'];

        $poolIndices = [
            'bike' => 0,
            'letne' => 0,
            'zimne' => 0,
            'moto' => 0,
            'traktor' => 0,
        ];

        $products = Product::with('category.parent')->orderBy('id')->get();

        foreach ($products as $product) {
            $parentName = strtolower((string) optional($product->category->parent)->name);

            if ($parentName === 'auto') {
                $season = strtolower((string) $product->season);
                if ($season === 'zimne') {
                    $mainImage = $zimneMain[$poolIndices['zimne'] % count($zimneMain)];
                    $poolIndices['zimne']++;
                } else {
                    $mainImage = $letneMain[$poolIndices['letne'] % count($letneMain)];
                    $poolIndices['letne']++;
                }
                $detailImages = $autoOrTractorDetail;
            } elseif ($parentName === 'moto') {
                $mainImage = $motoMain[$poolIndices['moto'] % count($motoMain)];
                $poolIndices['moto']++;
                $detailImages = $bikeOrMotoDetail;
            } elseif ($parentName === 'cyklo') {
                $mainImage = $bikeMain[$poolIndices['bike'] % count($bikeMain)];
                $poolIndices['bike']++;
                $detailImages = $bikeOrMotoDetail;
            } elseif ($parentName === 'traktorove') {
                $mainImage = $traktorMain[$poolIndices['traktor'] % count($traktorMain)];
                $poolIndices['traktor']++;
                $detailImages = $autoOrTractorDetail;
            } else {
                $mainImage = $letneMain[$poolIndices['letne'] % count($letneMain)];
                $poolIndices['letne']++;
                $detailImages = $autoOrTractorDetail;
            }

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => 'images/products/' . $mainImage,
                'is_main' => true,
            ]);

            foreach ($detailImages as $detailImage) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => 'images/products/' . $detailImage,
                    'is_main' => false,
                ]);
            }
        }
    }
}
