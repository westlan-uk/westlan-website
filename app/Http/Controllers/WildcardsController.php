<?php

namespace App\Http\Controllers;

use App\ShortUri;
use App\StaticPage;
use Illuminate\Http\Request;

class WildcardsController extends Controller
{
    public function __invoke($link)
    {
        $staticPage = StaticPage::where('link', $link)->first();

        if (isset($staticPage)) {
            return view('staticpages.show', ['page' => $staticPage]);
        }

        // Fallback and check custom Short URIs
        $shortUri = ShortUri::where('shortcode', $link)->firstOrFail();
        $shortUri->clicked++;
        $shortUri->save();

        return redirect($shortUri->uri);
    }
}
