<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseDetail extends Model
{
    protected $fillable = [
        'expense_id',
        'debtor_id',
        'amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'expense_id' => 'integer',
            'debtor_id' => 'integer',
            'amount' => 'decimal:2',
        ];
    }
    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function debtor()
    {
        return $this->belongsTo(User::class, 'debtor_id');
    }
}
