<?php

namespace App\Http\Controllers;

use App\Models\Offer;

class RealtorListingAcceptOfferController extends Controller
{
    public function __invoke(Offer $offer)
    {
        $listing = $offer->listing;

        $this->authorize('update', $listing);

        // Accept selected offer
        $offer->update([
            'accepted_at' => now(),
        ]);

        $listing->sold_at = now();
        $listing->save();

        // Reject All other offers
        $listing->offers()->except($offer)->update([
            'rejected_at' => now(),
        ]);

        return back()->with('success', 'Offer Accepted Successfully');
    }
}
