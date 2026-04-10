<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $rawCat = strtolower((string) $request->query('cat', 'all'));

        $forcedSeason = null;
        $categoryKey = match ($rawCat) {
            'auto', 'moto', 'bicycle', 'tractor', 'all' => $rawCat,
            'winter' => 'auto',
            'summer' => 'auto',
            default => 'all',
        };

        if ($rawCat === 'winter') {
            $forcedSeason = 'zimne';
        } elseif ($rawCat === 'summer') {
            $forcedSeason = 'letne';
        }

        $parentCategoryName = match ($categoryKey) {
            'moto' => 'Moto',
            'bicycle' => 'Cyklo',
            'tractor' => 'Traktorove',
            'auto' => 'Auto',
            default => null,
        };

        $baseQuery = Product::query()
            ->with(['images' => fn ($q) => $q->orderByDesc('is_main')->orderBy('id')]);

        if ($parentCategoryName !== null) {
            $baseQuery->whereHas('category.parent', fn (Builder $q) => $q->where('name', $parentCategoryName));
        }

        if ($forcedSeason !== null) {
            $baseQuery->where('season', $forcedSeason);
        }

        $filterScope = (clone $baseQuery);

        $brands = array_values(array_filter((array) $request->query('brand', [])));
        if (! empty($brands)) {
            $baseQuery->whereIn('brand', $brands);
        }

        $priceFrom = $request->query('price_from');
        if (is_numeric($priceFrom)) {
            $baseQuery->where('price', '>=', (float) $priceFrom);
        }

        $priceTo = $request->query('price_to');
        if (is_numeric($priceTo)) {
            $baseQuery->where('price', '<=', (float) $priceTo);
        }

        if (($categoryKey === 'auto' || $categoryKey === 'all') && $forcedSeason === null) {
            $season = $request->query('season');
            if (filled($season)) {
                $baseQuery->where('season', $season);
            }
        }

        if (in_array($categoryKey, ['auto', 'bicycle', 'all'], true)) {
            $hasSpikes = $request->query('has_spikes');
            if ($hasSpikes === '1' || $hasSpikes === '0') {
                $baseQuery->where('has_spikes', $hasSpikes === '1');
            }
        }

        $width = $request->query('width');
        if (is_numeric($width)) {
            $baseQuery->where('width', (int) $width);
        }

        if (in_array($categoryKey, ['auto', 'moto', 'tractor', 'all'], true)) {
            $profile = $request->query('profile');
            if (is_numeric($profile)) {
                $baseQuery->where('profile', (int) $profile);
            }
        }

        $diameter = $request->query('diameter');
        if (filled($diameter)) {
            $baseQuery->where('diameter', $diameter);
        }

        $search = trim((string) $request->query('q', ''));
        if ($search !== '') {
            $baseQuery->where(function (Builder $q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('brand', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $sort = $request->query('sort', 'default');
        match ($sort) {
            'price_asc' => $baseQuery->orderBy('price'),
            'price_desc' => $baseQuery->orderByDesc('price'),
            'name_asc' => $baseQuery->orderBy('name'),
            'name_desc' => $baseQuery->orderByDesc('name'),
            default => $baseQuery->orderByDesc('id'),
        };

        $products = $baseQuery->paginate(9)->withQueryString();

        $availableBrands = (clone $filterScope)
            ->whereNotNull('brand')
            ->select('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        $availableWidths = (clone $filterScope)
            ->whereNotNull('width')
            ->select('width')
            ->distinct()
            ->orderBy('width')
            ->pluck('width');

        $availableProfiles = (clone $filterScope)
            ->whereNotNull('profile')
            ->select('profile')
            ->distinct()
            ->orderBy('profile')
            ->pluck('profile');

        $availableDiameters = (clone $filterScope)
            ->whereNotNull('diameter')
            ->select('diameter')
            ->distinct()
            ->orderBy('diameter')
            ->pluck('diameter');

        $availableSeasons = (clone $filterScope)
            ->whereNotNull('season')
            ->select('season')
            ->distinct()
            ->orderBy('season')
            ->pluck('season');

        $categoryLabel = match ($categoryKey) {
            'moto' => 'Moto pneumatiky',
            'bicycle' => 'Cyklo pneumatiky',
            'tractor' => 'Traktorove pneumatiky',
            'all' => 'Všetky pneu',
            default => 'Auto pneumatiky',
        };

        return view('products', [
            'products' => $products,
            'categoryKey' => $categoryKey,
            'categoryLabel' => $categoryLabel,
            'seasonLocked' => $forcedSeason !== null,
            'selectedBrands' => $brands,
            'availableBrands' => $availableBrands,
            'availableWidths' => $availableWidths,
            'availableProfiles' => $availableProfiles,
            'availableDiameters' => $availableDiameters,
            'availableSeasons' => $availableSeasons,
            'sort' => $sort,
            'search' => $search,
        ]);
    }
}
