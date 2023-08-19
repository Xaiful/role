<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Product;
use App\Models\RawMaterialsShop;
use App\Models\RawMaterialsStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RawMaterials extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'memo_no',
        'unit_price',
        'raw_materials_shop_id',
        'quantity',
        'subcategory_id',
        'unit_id',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
    public function RawMaterialsStock()
    {
        return $this->hasMany(RawMaterialsStock::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
    public function rawmaterialShops()
    {
        return $this->hasOne(RawMaterialsShop::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_raw_materials_pivot')
            ->withPivot('quantity'); // Include the quantity column from the pivot table
    }
}
