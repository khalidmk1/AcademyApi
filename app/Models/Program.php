<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'title',
        'Description',
        'tags',
        'categories'
    ];


     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array',
        'categories' => 'array',
    ];


    /**
     * Get all of the CourFormation for the Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function CourFormation(): HasMany
    {
        return $this->hasMany(CoursFormation::class, 'program_id');
    }
}
