<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [ 'sale_id', 'item_id', 'quantity', 'unit_price', 'full_price'];

    public function sales()
    {
        return $this->belongsTo(Sale::class , 'sale_id');
    }
    public function items()
    {
        return $this->belongsTo(Item::class , 'item_id');
    }
}
