<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Notifications\OfferMade;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, Request $request)
    {
        $this->authorize('view', $listing);

        $offer = $listing->offers()->make(
            $request->validate([
                'amount' => 'required|integer|min:1|max:20000000',
            ])
        );
        $offer->bidder()->associate(auth()->user())->save();

        $listing->owner->notify(new OfferMade($offer));

        return back()->with('success', 'Offer sent successfully');
    }
}
