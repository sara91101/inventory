<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpensesItem extends Model
{
    use SoftDeletes;
    
    protected $fillable = ['item'];
}
