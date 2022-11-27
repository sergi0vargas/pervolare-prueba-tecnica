<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'soft_delete', 'name', 'type', 'description'];

    protected $casts = [
        'soft_delete' => 'date',
    ];
}
