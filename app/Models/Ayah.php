<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayah extends Model
{
    use HasFactory;

    protected $fillable = ['ayah_no', 'no_all', 'verse', 'en_verse', 'sajda', 'surah_id'];

    public function surah()
    {
        # code...
        return $this->belongsTo(Surah::class);
    }
}
