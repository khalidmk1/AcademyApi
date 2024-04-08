<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CoursFormation extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'cours_id',
        'host_id',
        'program_id',
        'title',
        'isCertify',
        'documents',
        'image',
        'condition'
    ];

    protected $casts = [
        'documents' => 'array',
    ];


    /**
     * Get the user that owns the CoursFormation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'host_id');
    }

    /**
     * Get the cours that owns the CoursFormation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours(): BelongsTo
    {
        return $this->belongsTo(Cour::class, 'cours_id');
    }

    /**
     * Get the program that owns the CoursFormation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'program_id');
    }


    /**
     * Get all of the CoursFormationVideo for the CoursFormation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function CoursFormationVideo(): HasMany
    {
        return $this->hasMany(CoursFormationVideo::class, 'CourFormation_id');
    }
}
