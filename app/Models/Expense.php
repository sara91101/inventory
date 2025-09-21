<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    protected $fillable = ['expense_item_id', 'branch_id','warehouse_id','price', 'description'];

    public function expenseItem()
    {
        return $this->belongsTo(ExpensesItem::class, 'expense_item_id');
    }

    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function warehouses()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }
}
