<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colocation extends Model
{
    protected $fillable = [
        'name',
        'status',
        'created_by',
    ];

    protected function casts(): array{return ['created_by' => 'integer',];}

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }
}
