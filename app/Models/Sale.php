<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use SoftDeletes;

    protected $fillable = ['sale_date', 'customer_id', 'full_amount','notes'];

    public function customers()
    {
        return $this->belongsTo(Customer::class , 'customer_id');
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class , 'sale_id');
    }
}
