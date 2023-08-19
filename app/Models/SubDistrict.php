<?php

namespace App\Models;

use App\Models\District;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubDistrict extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'district_id'
    ] ;

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
