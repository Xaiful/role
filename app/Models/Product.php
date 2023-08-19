<?php

namespace App\Models;

use App\Models\RawMaterials;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];
    public function rawMaterials()
    {
        return $this->belongsToMany(RawMaterials::class, 'product_raw_materials_pivot')
            ->withPivot('quantity');
    }
}
