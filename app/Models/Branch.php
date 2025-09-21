<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['branch'];

    public function warehouses()
    {
        return $this->hasMany(Warehouse::class, 'branch_id');
    }
    
    public function expenses()
    {
        return $this->hasMany(Expense::class, 'branch_id');
    }
}
