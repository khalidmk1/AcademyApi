<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory , SoftDeletes;


    protected $fillable = [
        'domain_id',
        'category_name',
    ];



   /**
     * Get the souscategories for the category.
     */
    public function souscategories(): HasMany
    {
        return $this->hasMany(SousCategory::class , 'category_id');
    }

    /**
     * Get the domain that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class, 'domain_id');
    }


    /**
     * Get all of the cours for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cours(): HasMany
    {
        return $this->hasMany(Cour::class, 'category_id');
    }

}
