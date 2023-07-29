<?php

namespace App\Models;

use App\Traits\UserAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, UserAudit, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public $timestamps = true;

    /**
     * Get the category that owns the product.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Returns the category that owns the product.
     */
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
