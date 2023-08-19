<?php

namespace App\Models;

use App\Models\Devision;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'devision_id'
    ] ;

    public function devision()
    {
        return $this->belongsTo(Devision::class);
    }
}
