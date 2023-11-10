<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingOfferController extends Controller
{
    public function store(Listing $listing, Request $request)
    {
        $listing->offers()->make(
            $request->validate([
                'amount' => 'required|integer|min:1|max:20000000',
            ])
        )->bidder()->associate(auth()->user())->save();

        return back()->with('success', 'Offer sent successfully');
    }
}
