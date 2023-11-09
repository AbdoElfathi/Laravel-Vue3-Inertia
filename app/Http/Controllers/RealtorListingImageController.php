<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RealtorListingImageController extends Controller
{
    public function create(Listing $listing)
    {
        $listing->load(['images']);

        return inertia(
            'Realtor/ListingImage/Create',
            ['listing' => $listing]
        );
    }

    public function store(Request $request, Listing $listing)
    {
        $request->validate([
            'images.*' => 'mimes:jpg, jpeg, pngn webp|max:5000',
        ], [
            'images.*.mimes' => 'You must upload an image',
        ]);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('images', 'public');

                $listing->images()->save(new ListingImage([
                    'filename' => $path,
                ]));

            }

            return redirect()->back()->with('success', 'Images uploaded successfully');
        }
    }

    public function destroy(ListingImage $image)
    {
        Storage::disk('public')->delete($image->filename);
        $image->delete();

        return redirect()->back()->with('success', 'Images deleted successfully');
    }
}
