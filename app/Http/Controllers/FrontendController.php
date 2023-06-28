<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Komentar;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(){
        $blog=Artikel::orderby('updated_at','desc')->get()->take(9);
        return view('frontend.index',compact('blog'));
    }
    public function blog()
    {
        //blog
        $artikels = Artikel::orderby('updated_at','desc')->with(['users','komentarnya','komentars', 'komentars.child'])->paginate(10);
        //blogrecent
        $artikelrecents = Artikel::orderby('updated_at','desc')->get()->take(5);
        return view('frontend.blog',compact('artikels','artikelrecents'));
    }
    public function singleblog($slug)
    {
        
        //artikelread
        $artikel = Artikel::with(['users','komentarnya','komentars', 'komentars.child'])->where('slug', $slug)->firstOrFail();
        //hitungkomentar
        $artikel_id=$artikel->id;
        $hitung_komentar = Komentar::where('artikel_id',$artikel_id)->get()->count();
        // dd($hitung_komentar);
        
        //artikelrecent
        $artikelrecents = Artikel::orderby('updated_at','desc')->get()->take(5);

        return view('frontend.singleblog',compact('artikel','artikelrecents','hitung_komentar'));
    }
}
