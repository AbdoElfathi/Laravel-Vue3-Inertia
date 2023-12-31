<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ListingController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Listing::class, 'listing');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['priceFrom', 'priceTo', 'beds', 'baths', 'areaFrom', 'areaTo']);

        return Inertia::render('Listing/Index',
            [
                'filters' => $filters,
                'listings' => Listing::mostRecent()
                    ->withoutSold()
                    ->filter($filters)
                    ->paginate(10)
                    ->withQueryString(),
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        // if (auth()->user()->cannot('view', $listing)) {
        //     abort(403);
        // }
        // $this->authorize('view', $listing);
        $listing->load(['images']);
        $offer = ! auth()->check() ? null : $listing->offers()->byMe()->first();

        return inertia(
            'Listing/Show',
            [
                'offerMade' => $offer,

                'listing' => $listing,
            ]
        );
    }
}
