<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $fillable = [
        'colocation_id',
        'email',
        'token',
        'status',
    ];

    protected $hidden = [
        'token',
    ];

    protected function casts(): array
    {
        return [
            'colocation_id' => 'integer',
        ];
    }
}
