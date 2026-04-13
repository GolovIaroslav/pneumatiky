<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show(int $id)
    {
        $product = Product::with([
            'images'   => fn ($q) => $q->orderByDesc('is_main')->orderBy('id'),
            'category',
        ])->findOrFail($id);

        $related = Product::with(['images' => fn ($q) => $q->orderByDesc('is_main')])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('product-detail', compact('product', 'related'));
    }

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

        $filterCapabilities = $this->getFilterCapabilities($categoryKey, $forcedSeason);

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

        // Parse all filter inputs as arrays
        $brands = array_values(array_filter((array) $request->query('brand', [])));
        $seasons = $filterCapabilities['seasons']
            ? array_values(array_filter((array) $request->query('season', [])))
            : [];
        $widths = array_values(array_filter(array_map('intval', (array) $request->query('width', []))));
        $profiles = $filterCapabilities['profiles']
            ? array_values(array_filter(array_map('intval', (array) $request->query('profile', []))))
            : [];
        $diameters = array_values(array_filter((array) $request->query('diameter', [])));
        $hasSpikes = $filterCapabilities['hasSpikes'] ? (array) $request->query('has_spikes', []) : [];

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

        if ($filterCapabilities['seasons'] && $forcedSeason === null) {
            if (! empty($seasons)) {
                $baseQuery->whereIn('season', $seasons);
            }
        }

        if ($filterCapabilities['hasSpikes']) {
            if (! empty($hasSpikes)) {
                if (count($hasSpikes) === 1) {
                    $baseQuery->where('has_spikes', $hasSpikes[0] === '1');
                }
            }
        }

        if (! empty($widths)) {
            $baseQuery->whereIn('width', $widths);
        }

        if ($filterCapabilities['profiles']) {
            if (! empty($profiles)) {
                $baseQuery->whereIn('profile', $profiles);
            }
        }

        if (! empty($diameters)) {
            $baseQuery->whereIn('diameter', $diameters);
        }

        $search = trim((string) $request->query('q', ''));
        if ($search !== '') {
            $terms = array_values(array_filter(preg_split('/\s+/u', $search) ?: []));

            $baseQuery->where(function (Builder $q) use ($terms) {
                foreach ($terms as $term) {
                    $q->where(function (Builder $subQuery) use ($term) {
                        $like = '%' . $term . '%';
                        if (config('database.default') === 'pgsql') {
                            $subQuery->where('name', 'ilike', $like)
                                ->orWhere('brand', 'ilike', $like);
                        } else {
                            $subQuery->where('name', 'like', $like)
                                ->orWhere('brand', 'like', $like);
                        }
                    });
                }
            });
        }

        $sort = $request->query('sort', 'default');
        match ($sort) {
            'price_asc' => $baseQuery->orderBy('price'),
            'price_desc' => $baseQuery->orderByDesc('price'),
            'name_asc' => $baseQuery->orderBy('brand')->orderBy('name'),
            'name_desc' => $baseQuery->orderByDesc('brand')->orderByDesc('name'),
            default => $baseQuery->orderByDesc('id'),
        };

        $products = $baseQuery->paginate(9)->withQueryString();

        // Get min/max prices for this category
        $minPrice = (clone $filterScope)->min('price') ?? 22;
        $maxPrice = (clone $filterScope)->max('price') ?? 270;

        // Get current price filters or defaults
        $currentPriceFrom = filled($priceFrom) ? (float) $priceFrom : $minPrice;
        $currentPriceTo = filled($priceTo) ? (float) $priceTo : $maxPrice;

        // Get all available options
        $availableBrands = (clone $filterScope)
            ->whereNotNull('brand')
            ->select('brand')
            ->distinct()
            ->orderBy('brand')
            ->pluck('brand');

        $availableSeasons = (clone $filterScope)
            ->whereNotNull('season')
            ->select('season')
            ->distinct()
            ->orderBy('season')
            ->pluck('season');

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

        // Calculate which filter options are available with current selections
        $disabledFilterOptions = $this->calculateDisabledOptions(
            $filterScope,
            [
                'brands' => $brands,
                'seasons' => $seasons,
                'widths' => $widths,
                'profiles' => $profiles,
                'diameters' => $diameters,
                'hasSpikes' => $hasSpikes,
            ],
            $filterCapabilities
        );

        $categoryLabel = match ($categoryKey) {
            'moto' => 'Moto pneumatiky',
            'bicycle' => 'Cyklo pneumatiky',
            'tractor' => 'Traktorove pneumatiky',
            'all' => 'Všetky pneu',
            default => 'Auto pneumatiky',
        };

        // Calculate pagination window (show 5 pages around current page)
        $currentPage = $products->currentPage();
        $lastPage = $products->lastPage();
        $paginationStart = max(1, $currentPage - 2);
        $paginationEnd = min($lastPage, $paginationStart + 4);
        $paginationStart = max(1, $paginationEnd - 4);

        return view('products', [
            'products' => $products,
            'categoryKey' => $categoryKey,
            'categoryLabel' => $categoryLabel,
            'seasonLocked' => $forcedSeason !== null,
            'filterCapabilities' => $filterCapabilities,
            'selectedBrands' => $brands,
            'selectedSeasons' => $seasons,
            'selectedWidths' => $widths,
            'selectedProfiles' => $profiles,
            'selectedDiameters' => $diameters,
            'selectedHasSpikes' => $hasSpikes,
            'availableBrands' => $availableBrands,
            'availableSeasons' => $availableSeasons,
            'availableWidths' => $availableWidths,
            'availableProfiles' => $availableProfiles,
            'availableDiameters' => $availableDiameters,
            'disabledFilterOptions' => $disabledFilterOptions,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'currentPriceFrom' => $currentPriceFrom,
            'currentPriceTo' => $currentPriceTo,
            'sort' => $sort,
            'search' => $search,
            'paginationStart' => $paginationStart,
            'paginationEnd' => $paginationEnd,
        ]);
    }

    private function calculateDisabledOptions($filterScope, array $selectedFilters, array $filterCapabilities)
    {
        $disabled = [
            'brands' => [],
            'seasons' => [],
            'widths' => [],
            'profiles' => [],
            'diameters' => [],
            'hasSpikes' => [],
        ];

        // For each potential filter value, check if it has any products
        $baseQuery = clone $filterScope;

    $brands = $selectedFilters['brands'] ?? [];
    $seasons = $filterCapabilities['seasons'] ? ($selectedFilters['seasons'] ?? []) : [];
    $widths = $selectedFilters['widths'] ?? [];
    $profiles = $filterCapabilities['profiles'] ? ($selectedFilters['profiles'] ?? []) : [];
    $diameters = $selectedFilters['diameters'] ?? [];
    $hasSpikes = $filterCapabilities['hasSpikes'] ? ($selectedFilters['hasSpikes'] ?? []) : [];

        // Check brand availability
        $availableBrands = $baseQuery
            ->when(! empty($seasons), fn ($q) => $q->whereIn('season', $seasons))
            ->when(! empty($widths), fn ($q) => $q->whereIn('width', $widths))
            ->when(! empty($profiles), fn ($q) => $q->whereIn('profile', $profiles))
            ->when(! empty($diameters), fn ($q) => $q->whereIn('diameter', $diameters))
            ->select('brand')
            ->distinct()
            ->pluck('brand')
            ->all();

        // Check season availability
        $availableSeasons = (clone $filterScope)
            ->when(! empty($brands), fn ($q) => $q->whereIn('brand', $brands))
            ->when(! empty($widths), fn ($q) => $q->whereIn('width', $widths))
            ->when(! empty($profiles), fn ($q) => $q->whereIn('profile', $profiles))
            ->when(! empty($diameters), fn ($q) => $q->whereIn('diameter', $diameters))
            ->select('season')
            ->distinct()
            ->pluck('season')
            ->all();

        // Check width availability
        $availableWidths = (clone $filterScope)
            ->when(! empty($brands), fn ($q) => $q->whereIn('brand', $brands))
            ->when(! empty($seasons), fn ($q) => $q->whereIn('season', $seasons))
            ->when(! empty($profiles), fn ($q) => $q->whereIn('profile', $profiles))
            ->when(! empty($diameters), fn ($q) => $q->whereIn('diameter', $diameters))
            ->select('width')
            ->distinct()
            ->pluck('width')
            ->all();

        // Check profile availability
        $availableProfiles = (clone $filterScope)
            ->when(! empty($brands), fn ($q) => $q->whereIn('brand', $brands))
            ->when(! empty($seasons), fn ($q) => $q->whereIn('season', $seasons))
            ->when(! empty($widths), fn ($q) => $q->whereIn('width', $widths))
            ->when(! empty($diameters), fn ($q) => $q->whereIn('diameter', $diameters))
            ->select('profile')
            ->distinct()
            ->pluck('profile')
            ->all();

        // Check diameter availability
        $availableDiameters = (clone $filterScope)
            ->when(! empty($brands), fn ($q) => $q->whereIn('brand', $brands))
            ->when(! empty($seasons), fn ($q) => $q->whereIn('season', $seasons))
            ->when(! empty($widths), fn ($q) => $q->whereIn('width', $widths))
            ->when(! empty($profiles), fn ($q) => $q->whereIn('profile', $profiles))
            ->select('diameter')
            ->distinct()
            ->pluck('diameter')
            ->all();

        return [
            'brands' => $availableBrands,
            'seasons' => $availableSeasons,
            'widths' => $availableWidths,
            'profiles' => $availableProfiles,
            'diameters' => $availableDiameters,
        ];
    }

    private function getFilterCapabilities(string $categoryKey, ?string $forcedSeason): array
    {
        return [
            'seasons' => $forcedSeason === null,
            'hasSpikes' => in_array($categoryKey, ['auto', 'bicycle', 'all'], true),
            'profiles' => in_array($categoryKey, ['auto', 'moto', 'tractor', 'all'], true),
        ];
    }
}
