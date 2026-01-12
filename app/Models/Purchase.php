<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Purchase extends Model
{
    use SoftDeletes;

    protected $fillable = ['purchase_date', 'supplier_id', 'full_amount', 'notes'];

    public function suppliers()
    {
        return $this->belongsTo(Supplier::class , 'supplier_id');
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class , 'purchase_id');
    }
}
