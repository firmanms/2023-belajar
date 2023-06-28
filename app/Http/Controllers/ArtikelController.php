<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Komentar;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    public function index()
    {
        // $artikel = Artikel::with('users')->latest()->get();
        // dd($artikel);
        if(request()->ajax()) {
            $artikel = Artikel::orderby('updated_at','desc')->with('users')->latest()->get();
            // dd($artikel);
            return datatables()->of($artikel)
            ->addColumn('image', function ($artikel) {
                $url= url('storage/gambar/'.$artikel->gambar);
                return '<img src="'.$url.'" border="0" width="100" class="img-rounded" align="center" />';
            })
            ->addColumn('tanggal', function ($artikel) {
                $updatenya= date_format($artikel->updated_at,"d/m/Y");
                return $updatenya ;
            })
            ->addColumn('action', 'artikel.action')
            ->rawColumns(['image','tanggal','action'])
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
        'user_id' => '',
        'judul' => 'required',
        'isi' => 'required',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        
        ]);
 
        //upload image
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/gambar', $gambar->hashName());
        // dd($profileGambar);
        $artikel = new Artikel();
        $artikel->user_id = $request->user_id;
        $artikel->judul = $request->judul;
        $artikel->slug = Str::slug($request->judul);
        $artikel->isi = $request->isi;
        $artikel->gambar = $gambar->hashName();
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
    public function show($id)
    {
        $artikel = Artikel::with(['users','komentarnya','komentars', 'komentars.child'])->where('id', $id)->first();
        // dd($artikel);
        return view('artikel.show', compact('artikel'));
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
    'user_id'=>'',
    'judul' => 'required',
    'isi' => 'required',
    'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

    // 'address' => 'required'
    ]);

    $artikel = Artikel::findOrFail($id);
    
    if($request->file('gambar') == "") {

        $artikel->update([
            'user_id' => $request->user_id,
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'isi' => $request->isi,
        ]);

    } else {

        //hapus old image
        Storage::disk('local')->delete('public/gambar/'.$artikel->gambar);

        //upload new image
        $gambar = $request->file('gambar');
        $gambar->storeAs('public/gambar', $gambar->hashName());

        $artikel->update([
            
            'judul'     => $request->judul,
            'slug'      => Str::slug($request->judul),
            'isi'       => $request->isi,
            'gambar'    => $gambar->hashName(),
        ]);

    }

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
    public function comment(Request $request)
    {
            //VALIDASI DATA YANG DITERIMA
            $this->validate($request, [
                
                'komentar' => 'required'
            ]);

            Komentar::create([
                'artikel_id' => $request->id,
                //JIKA PARENT ID TIDAK KOSONG, MAKA AKAN DISIMPAN IDNYA, SELAIN ITU NULL
                'parent_id' => $request->parent_id != '' ? $request->parent_id:NULL,
                'user_id' => $request->user_id,
                'komentar' => $request->komentar
            ]);
        return redirect()->back()->with(['success' => 'Komentar Ditambahkan']);
    }
}
