<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name','address','branch_id'];

    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
    
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'warehouse_id');
    }
}
