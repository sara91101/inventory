<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = [ 'purchase_id', 'item_id', 'quantity', 'dollar_unit_price', 'unit_price', 'full_price'];

    public function purchases()
    {
        return $this->belongsTo(Purchase::class , 'purchase_id');
    }

    public function items()
    {
        return $this->belongsTo(Item::class , 'item_id');
    }
}
