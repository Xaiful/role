<?php

namespace App\Models;

use App\Models\RawMaterials;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',        
        'rawmaterial_id',        

    ];
    public function rawmaterial()
    {
        return $this->hasMany(RawMaterials::class);
    }   
}
