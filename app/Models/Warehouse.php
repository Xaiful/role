<?php

namespace App\Models;

use App\Models\WarehouseProduct;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class,'warehouses_products','warehouse_id','product_id')
                    ->using(WarehouseProduct::class)
                    ->withPivot(['quantity', 'damage', 'status'])
                    ->withTimestamps();
    }
    
}
