<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'title',
        'amount',
        'category_id',
        'date',
    ];

    // Define relationship: Expense belongs to a Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
