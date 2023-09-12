<?php

namespace App\Models;

use App\Models\Devision;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RolesDevision extends Model
{
    use HasFactory;
    protected $table = 'roles_devisions';
    public function devision()
    {
        return $this->belongsTo(Devision::class);
    }
}
