<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->sex) {
            $datas = Anggota::where('sex', $request->sex)->get();
        } else {
            $datas = Anggota::all();
        }

        return DataTables::of($datas)
            ->addIndexColumn()
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // return view('admin.anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'sex' => [
                'required',
                Rule::in(['L', 'P'])
            ],
            'telp' => 'required',
            'alamat' => 'required',
            'email' => 'required',
        ]);

        Anggota::create($validate);

        return redirect('anggota');
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
        //
        // $anggota = Anggota::findOrFail($id);
        // return view('admin.anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anggota $anggotum)
    {

        $validate = $request->validate([
            'name' => 'required',
            'sex' => [
                'required',
                Rule::in(['L', 'P'])
            ],
            'telp' => 'required',
            'alamat' => 'required',
            'email' => 'required',
        ]);

        $anggotum->update($validate);

        return redirect('anggota');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Anggota::destroy($id);
        return redirect('anggota');
    }
}
