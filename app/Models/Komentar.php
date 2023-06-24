<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users () {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function posts () {
        return $this->belongsTo(Artikel::class,'artikel_id','id');
    }

    public function child()
    {
        return $this->hasMany(Komentar::class, 'parent_id');
    }
}
