<?php

namespace App\Models;

use App\Traits\UserAudit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, UserAudit, SoftDeletes;

    protected $guarded = [
        'id'
    ];

    public $timestamps = true;

    /**
     * Get the products for the category.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany Returns the products for the category.
     */
    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(Product::class);
    }
}
