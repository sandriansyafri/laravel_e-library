<?php

namespace App\Http\Controllers;

use App\Models\Katalog;
use Illuminate\Http\Request;

class KatalogController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.katalog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate  = $request->validate([
            'name' => 'required'
        ]);

        //* OLD METHOD 
        // $katalog = new Katalog;
        // $katalog->name = $request->name;
        // $katalog->save();

        Katalog::create($validate);

        return redirect('katalog');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $katalog = Katalog::findOrFail($id);
        return view('admin.katalog.edit', compact('katalog'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Katalog $katalog)
    {
        $validate = $request->validate([
            'name' => 'required'
        ]);

        //*SLOW METHOD
        // Katalog::where('id', $katalog->id)->update([
        //     'name' => $request->name
        // ]);

        //* FAST METHDO
        $katalog->update($validate);

        return redirect('katalog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Katalog::destroy($id);
        return redirect('katalog');
    }
}
