<?php

namespace App\Http\Controllers;

use App\Aeropuerto;
use Illuminate\Http\Request;

class AeropuertoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $aeropuertos = Aeropuerto::latest()->paginate(5);
  
        return view('aeropuertos.index',compact('aeropuertos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('aeropuertos.create');
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
        $request->validate([
            'sigla_oaci' => 'required',
            'nombre' => 'required',
            'arp' => 'required',
        ]);
        Aeropuerto::create($request->all());
   
        return redirect()->route('aeropuertos.index')
                        ->with('success','Airport created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function show(Aeropuerto $aeropuerto)
    {
        //
        return view('aeropuertos.show',compact('aeropuerto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function edit(Aeropuerto $aeropuerto)
    {
        //
        return view('aeropuertos.edit',compact('aeropuerto'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aeropuerto $aeropuerto)
    {
        //
        $request->validate([
            'sigla_oaci' => 'required',
            'nombre' => 'required',
            'arp' => 'required',

        ]);
  
        $aeropuerto->update($request->all());
  
        return redirect()->route('aeropuertos.index')
                        ->with('success','Airport updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aeropuerto $aeropuerto)
    {
        //
        return redirect()->route('aeropuertos.index')
        ->with('success','Airport deleted successfully');
    }
}
