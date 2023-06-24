<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul', 'slug', 'isi','gambar'
    ];

    public function users () {
        return $this->belongsTo(User::class,'user_id', 'id');
      }
    
    public function komentars()
    {
        return $this->hasMany(Komentar::class)->whereNull('parent_id');
    }

    public function komentarnya () {
        return $this->hasMany(Komentar::class,'user_id','user_id');
    }
    public function komentarnya2 () {
        return $this->hasMany(Komentar::class,'artikel_id','id');
    }
}
