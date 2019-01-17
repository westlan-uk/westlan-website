<?php

namespace App\Http\Controllers;

use App\Survey;
use App\SurveyOption;
use App\UserVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SurveysController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::user()->role->site_admin) {
            abort(403);
        }

        return view('surveys.index', [
            'surveys' => Survey::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::user()->role->site_admin) {
            abort(403);
        }

        return view('surveys.create');
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
            'newOption.*' => 'required|string',
        ]);

        $newOptions = $request->input('newOption');

        if (empty($newOptions)) {
            return back()->withInput()->with('status', 'No options provided.');
        }

        $survey = Survey::create(['name' => $request->input('name')]);

        foreach ($newOptions as $name) {
            SurveyOption::create([
                'survey_id' => $survey->id,
                'name' => $name,
            ]);
        }

        return redirect('/surveys/' . $survey->id)->with('status', 'Survey successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function show(Survey $survey)
    {
        $voterId = Auth::user()->id;

        $vote = $survey->votes->where('user_id', $voterId)->first();

        return view('surveys.show', [
            'survey' => $survey,
            'vote' => $vote
        ]);
    }

    public function vote(Survey $survey, SurveyOption $surveyOption)
    {
        UserVote::create([
            'user_id' => Auth::user()->id,
            'survey_option_id' => $surveyOption->id,
        ]);

        return redirect('/surveys/' . $survey->id)->with('status', 'Vote registered.');
    }

    public function clearVote(Survey $survey)
    {
        $voterId = Auth::user()->id;
        $survey->votes->where('user_id', $voterId)->first()->delete();

        return redirect('/surveys/' . $survey->id)->with('status', 'Vote cleared.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function edit(Survey $survey)
    {
        if (!Auth::user()->role->site_admin) {
            abort(403);
        }

        return view('surveys.edit', ['survey' => $survey]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Survey $survey)
    {
        if (!Auth::user()->role->site_admin) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string',
            'option.*' => 'required|string',
            'newOption.*' => 'nullable|string',
            'delete.*' => 'nullable|integer',
        ]);
        
        $existingOptions = $request->input('option');
        $newOptions = $request->input('newOption');
        $deletes = $request->input('delete');

        if (empty($existingOptions) && empty($newOptions)) {
            return back()->withInput()->with('status', 'No options provided.');
        }

        if (!empty($existingOptions)) {
            foreach ($existingOptions as $key => $name) {
                SurveyOption::find($key)->update(['name' => $name]);
            }
        }

        if (!empty($newOptions)) {
            foreach ($newOptions as $name) {
                SurveyOption::create([
                    'survey_id' => $survey->id,
                    'name' => $name,
                ]);
            }
        }

        if (!empty($deletes)) {
            SurveyOption::destroy($deletes);
        }

        return redirect('/surveys')->with('status', 'Survey successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Survey  $survey
     * @return \Illuminate\Http\Response
     */
    public function destroy(Survey $survey)
    {
        if (!Auth::user()->role->site_admin) {
            abort(403);
        }
        //
    }
}
