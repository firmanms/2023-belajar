<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomentarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iduser=Auth::user()->id;
        if (Auth::user()->role=='admin') {
            $komentar = Komentar::with('posts','users')->latest()->get();
        } else {
            $komentar = Komentar::with('posts','users')->where('user_id',$iduser )->latest()->get();
        }
        
        
        if(request()->ajax()) {
            
            // dd($komentar);
            return datatables()->of($komentar)
            ->addColumn('tanggal', function ($komentar) {
                $updatenya= date_format($komentar->updated_at,"d/m/Y");
                return $updatenya ;
            })
            ->addColumn('judulartikel', function ($komentar) {
                $judul= $komentar->posts->judul;
                // dd($judul);
                return $judul ;
            })
            ->addColumn('action', 'komentar.action')
            ->rawColumns(['judulartikel','tanggal','action'])
            ->addIndexColumn()
            ->make(true);
            }
        return view('komentar.index');
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
    public function edit(Komentar $komentar)
    {
        $filter=$komentar->user_id;
        // $filter2=Auth::user()->id;
        // dd($filter);
        if (Auth::user()->role=='admin') {
        return view('komentar.edit',compact('komentar'));
        }elseif (Auth::user()->id==$filter){
        return view('komentar.edit',compact('komentar'));   
        }else{
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required',
            ]);
        
            $komentar = Komentar::findOrFail($id);
                      
                $komentar->update([
                    'komentar' => $request->komentar,
                ]);
                return redirect()->route('komentar.index')
                ->with('success','komentar Has Been updated successfully');      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $com = Komentar::where('id',$request->id)->delete();
    return Response()->json($com);
    }
}
