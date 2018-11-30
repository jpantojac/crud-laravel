<?php

namespace App\Http\Controllers;

use App\Helicopter;
use Illuminate\Http\Request;

class HelicopterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $helicopters = Helicopter::paginate(5);
  
        return view('helicopters.index',compact('helicopters'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('helicopters.create');
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
            'type' => 'required',
            'name' => 'required',
            'speed' => 'required',
            'color' => 'required',
        ]);
  
        Helicopter::create($request->all());
   
        return redirect()->route('helicopters.index')
                        ->with('success','Helicopter created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Helicopter  $helicopter
     * @return \Illuminate\Http\Response
     */
    public function show(Helicopter $helicopter)
    {
        return view('helicopters.show',compact('helicopter'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Helicopter  $helicopter
     * @return \Illuminate\Http\Response
     */
    public function edit(Helicopter $helicopter)
    {
        return view('helicopters.edit',compact('helicopter'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Helicopter  $helicopter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Helicopter $helicopter)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'speed' => 'required',
            'color' => 'required',
        ]);
        $helicopter->update($request->all());
  
        return redirect()->route('helicopters.index')
                        ->with('success','Helicopter updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Helicopter  $helicopter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Helicopter $helicopter)
    {
        $helicopter->delete();
  
        return redirect()->route('helicopters.index')
                        ->with('success','Helicopter deleted successfully');
    }
}
