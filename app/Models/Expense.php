<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = [
        'colocation_id',
        'payer_id',
        'category_id',
        'title',
        'amount',
        'expense_date',
    ];

    protected function casts(): array
    {
        return [
            'colocation_id' => 'integer',
            'payer_id' => 'integer',
            'category_id' => 'integer',
            'amount' => 'decimal:2',
            'expense_date' => 'date',
        ];
    }
    public function details()
    {
        return $this->hasMany(ExpenseDetail::class);
    }
    public function payer()
    {
        return $this->belongsTo(User::class, 'payer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
