<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Goal extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'souscategory_id',
        'goals',
    ];

    
    /**
     * Get the souscategory that owns the Goal
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function souscategory(): BelongsTo
    {
        return $this->belongsTo(SousCategory::class);
    }


    /**
     * Get all of the Cour for the Goal
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Cour(): HasMany
    {
        return $this->hasMany(Cour::class, 'gaols_id');
    }

}
