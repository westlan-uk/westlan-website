<?php

namespace App\Http\Controllers;

use App\StaticPage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class StaticPagesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('check-permission:site_admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staticpages.index', [
            'staticPages' => StaticPage::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staticpages.create');
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
            'name' => 'required|string',
            'link' => 'required|string|max:40|unique:static_pages',
            'content' => 'required|string',
        ]);

        StaticPage::create([
            'name' => $request->input('name'),
            'link' => strtolower($request->input('link')),
            'content' => $request->input('content'),
        ]);

        return redirect('/staticpages')->with('status', 'Static Page successfully created.');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'upload' => 'image',
        ]);

        try {
            $file = $request->file('upload');
            $image = Image::make($file->path())->encode('jpg');

            // Generate hash name
            $hash = md5($image->__toString());
            $path = "img/static/{$hash}.jpg";

            // Save to public folder
            $image->save(public_path($path));
            $url = env('APP_URL') . '/' . $path;

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'uploaded' => false,
                    'error' => [
                        'message' => $e->getMessage()
                    ]
                ]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StaticPage $staticpage)
    {
        return view('staticpages.edit', ['page' => $staticpage]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaticPage $staticpage)
    {
        $request->validate([
            'name' => 'required|string',
            'link' => 'required|string|max:40|unique:static_pages,link,' . $staticpage->id,
            'content' => 'required|string',
        ]);

        $staticpage->name = $request->input('name');
        $staticpage->link = strtolower($request->input('link'));
        $staticpage->content = $request->input('content');
        $staticpage->save();

        return redirect('/staticpages')->with('status', 'Static Page successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StaticPage $staticpage)
    {
        //
    }
}
