<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['name','address','branch_id'];

    /**
     * Get the user that owns the Warehouse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function branches()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }
}
