<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surah extends Model
{
    use HasFactory;
    protected $fillable = ['s_no', 'name_ar', 'name_en', 'name_en_t', 'type'];

    public function ayahs()
    {
        # code...
        return $this->hasMany(Ayah::class);
    }
}
