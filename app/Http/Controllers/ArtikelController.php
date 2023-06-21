<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $data = Artikel::latest()->get();
    //         return Datatables::of($data)
    //                 ->addIndexColumn()
    //                 ->addColumn('action', function($row){
   
    //                        $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
     
    //                         return $btn;
    //                 })
    //                 ->rawColumns(['action'])
    //                 ->make(true);
    //     }
      
    //     return view('list-artikel');
    // }
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Artikel::select('*'))
            ->addColumn('action', 'artikel.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
            }
        return view('artikel.index');
    }
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('artikel.create');
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
        'judul' => 'required',
        'isi' => 'required',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        
        ]);
        if ($gambar = $request->file('gambar')) {
            $destinationPath = 'gambar/';
            $profileGambar = date('YmdHis') . "." . $gambar->getClientOriginalExtension();
            $gambar->move($destinationPath, $profileGambar);
            $inputgambar['gambar'] = "$profileGambar";
        }
        // dd($profileGambar);
        $artikel = new Artikel();
        $artikel->judul = $request->judul;
        $artikel->slug = Str::slug($request->judul);
        $artikel->isi = $request->isi;
        $artikel->gambar = $profileGambar;
        $artikel->save();
        // dd($inputgambar);
        return redirect()->route('artikel.index')
        ->with('success','artikel has been created successfully.');
    }
    /**
    * Display the specified resource.
    *
    * @param  \App\artikel  $artikel
    * @return \Illuminate\Http\Response
    */
    public function show(Artikel $artikel)
    {
    return view('artikel.show',compact('artikel'));
    } 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\artikel  $artikel
    * @return \Illuminate\Http\Response
    */
    public function edit(Artikel $artikel)
    {
    return view('artikel.edit',compact('artikel'));
    }
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\artikel  $artikel
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
    $request->validate([
    'judul' => 'required',
    'isi' => 'required',
    // 'address' => 'required'
    ]);
    $artikel = Artikel::find($id);
    $artikel->judul = $request->judul;
    $artikel->slug = Str::slug($request->judul);
    $artikel->isi = $request->isi;
    $artikel->gambar = $request->judul;
    $artikel->save();
    return redirect()->route('artikel.index')
    ->with('success','artikel Has Been updated successfully');
    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\artikel  $artikel
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request)
    {
    $com = Artikel::where('id',$request->id)->delete();
    return Response()->json($com);
    }
}
