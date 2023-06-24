<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        
        // dd($hitungmember);
        // $artikel = Artikel::with('users')->latest()->get();
        // dd($artikel);
        if(request()->ajax()) {
            
            $artikel = Artikel::with('users')->latest()->get();
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
            ->addColumn('action', 'action')
            ->rawColumns(['image','tanggal','action'])
            ->addIndexColumn()
            ->make(true);
            }
            $hitungmember='s';
            return view('dashboard',['data' => $hitungmember]);

    }
    
    public function show($id)
    {
        $artikel = Artikel::with(['users','komentarnya','komentars', 'komentars.child'])->where('id', $id)->first();
        // dd($artikel);
        return view('artikel.show', compact('artikel'));
    }
}
