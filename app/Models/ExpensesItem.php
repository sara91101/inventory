<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpensesItem extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['item'];

    
    public function expenseItem()
    {
        return $this->belongsTo(ExpensesItem::class, 'expense_item_id');
    }
}
