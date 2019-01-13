<?php

namespace App\Http\Controllers;

use App\ShortUri;
use Illuminate\Http\Request;

class ShortUrisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ShortUri  $shortUri
     * @return \Illuminate\Http\Response
     */
    public function show(ShortUri $shortUri)
    {
        //
    }

    public function go($shortcode)
    {
        $shortUri = ShortUri::where('shortcode', $shortcode)->first();

        if (isset($shortUri->uri)) {
            return redirect($shortUri->uri);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ShortUri  $shortUri
     * @return \Illuminate\Http\Response
     */
    public function edit(ShortUri $shortUri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ShortUri  $shortUri
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShortUri $shortUri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ShortUri  $shortUri
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShortUri $shortUri)
    {
        //
    }
}
