<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name', 'unit_id', 'category_id', 'description', 'barcode', 'price'];

    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
