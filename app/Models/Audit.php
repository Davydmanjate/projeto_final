<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'action', 'model', 'data_before', 'data_after'
    ];

    protected $casts = [
        'data_before' => 'array',
        'data_after' => 'array',
    ];
}
