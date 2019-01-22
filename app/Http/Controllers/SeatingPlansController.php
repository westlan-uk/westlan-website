<?php

namespace App\Http\Controllers;

use App\SeatingItem;
use App\SeatingPlan;
use Illuminate\Http\Request;

class SeatingPlansController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('seatingplans.index', [
            'plans' => SeatingPlan::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('seatingplans.create');
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
            'name' => 'required|string|unique:seating_plans',
        ]);

        $seatingPlan = SeatingPlan::create([
            'name' => $request->input('name'),
        ]);

        /**
         * table
         * dbl-table-1/2/3/4
         * other
         */

        $seatItems = $request->input('seatItem');

        if (!empty($seatItems)) {
            foreach ($seatItems as $x => $yArr) {
                foreach ($yArr as $y => $detail) {
                    $seatingItem = SeatingItem::where([
                        ['seating_plan_id', $seatingPlan->id],
                        ['pos_x', $x],
                        ['pos_y', $y],
                    ])->first();

                    if ($seatingItem === null) {
                        SeatingItem::create([
                            'seating_plan_id' => $seatingPlan->id,
                            'name' => $detail['name'],
                            'type' => $detail['type'],
                            'pos_x' => $x,
                            'pos_y' => $y,
                            'width' => $detail['width'],
                            'height' => $detail['height'],
                        ]);
                    }
                }
            }
        }

        return redirect('/seatingplans')->with('status', 'Seating Plan created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SeatingPlan  $seatingPlan
     * @return \Illuminate\Http\Response
     */
    public function show(SeatingPlan $seatingPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SeatingPlan  $seatingPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(SeatingPlan $seatingPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SeatingPlan  $seatingPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SeatingPlan $seatingPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SeatingPlan  $seatingPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(SeatingPlan $seatingPlan)
    {
        //
    }
}
