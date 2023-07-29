<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

trait UserAudit
{
    /**
     * Execute actions when the model is being created or updated.
     */
    protected static function booted()
    {
        static::creating(function (Model $model) {
            $model->created_by = auth()->id();
            $model->updated_by = auth()->id();
        });

        static::updating(function (Model $model) {
            $model->updated_by = auth()->id();
        });

        static::deleting(function (Model $model) {
            $model->deleted_by = auth()->id();
            $model->save();
        });
    }

    /**
     * Get the user that created the model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Returns the user that created the model.
     */
    public function createdBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the user that updated the model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Returns the user that updated the model.
     */
    public function updatedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Get the user that deleted the model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo Returns the user that deleted the model.
     */
    public function deletedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }
}
