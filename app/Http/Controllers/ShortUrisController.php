<?php

namespace App\Http\Controllers;

use App\ShortUri;
use Illuminate\Http\Request;

class ShortUrisController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'check-permission:site_admin'])->except(['go']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shorturis = ShortUri::get();
        return view('shorturis.index', ['shorturis' => $shorturis]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shorturis.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:80|unique:short_uris',
            'shortcode' => 'required|string|max:20|unique:short_uris',
            'uri' => 'required|url',
        ]);

        $shorturi = ShortUri::create([
            'name' => $request->input('name'),
            'shortcode' => strtolower($request->input('shortcode')),
            'uri' => $request->input('uri'),
        ]);

        return redirect('/shorturis/' . $shorturi->id)->with('status', 'Short URI saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShortUri  $shortUri
     * @return \Illuminate\Http\Response
     */
    public function show(ShortUri $shorturi)
    {
        return view('shorturis.show', ['shorturi' => $shorturi]);
    }

    public function go($shortcode)
    {
        $shortUri = ShortUri::where('shortcode', $shortcode)->first();

        if (isset($shortUri->uri)) {
            $shortUri->clicked++;
            $shortUri->save();

            return redirect($shortUri->uri);
        } else {
            return abort(404);
        }
    }

    public function resetClicked(ShortUri $shorturi)
    {
        $shorturi->clicked = 0;
        $shorturi->save();

        return redirect('/shorturis/' . $shorturi->id)->with('status', 'Clicked count successfully reset.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShortUri  $shortUri
     * @return \Illuminate\Http\Response
     */
    public function edit(ShortUri $shorturi)
    {
        return view('shorturis.edit', ['shorturi' => $shorturi]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShortUri  $shortUri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShortUri $shorturi)
    {
        $request->validate([
            'name' => 'required|string|max:80|unique:short_uris,name,' . $shorturi->id,
            'shortcode' => 'required|string|max:20|unique:short_uris,shortcode,' . $shorturi->id,
            'uri' => 'required|url',
        ]);

        $shorturi->name = $request->input('name');
        $shorturi->shortcode = strtolower($request->input('shortcode'));
        $shorturi->uri = $request->input('uri');
        $shorturi->save();

        return redirect('/shorturis/' . $shorturi->id)->with('status', 'Short URI successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShortUri  $shortUri
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShortUri $shorturi)
    {
        //
    }
}
