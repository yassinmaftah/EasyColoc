<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'colocation_id',
    ];

    protected function casts(): array
    {
        return [
            'colocation_id' => 'integer',
        ];
    }
    public function colocation()
    {
        return $this->belongsTo(Colocation::class);
    }
}
