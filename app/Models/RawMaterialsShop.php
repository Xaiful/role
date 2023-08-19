<?php

namespace App\Models;

use App\Models\RawMaterials;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RawMaterialsShop extends Model
{
    use HasFactory;
    protected $fillable = [
        'shopeName',
        'address',
        'phone',
        'rawmaterial_id'
    ];
    public function rawmaterial()
    {
        return $this->belongsTo(RawMaterials::class);
    }
    public function rawMaterials()
{
    return $this->hasMany(RawMaterials::class);
}

}
