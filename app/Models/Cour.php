<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cour extends Model
{
    use HasFactory , SoftDeletes;

     
    protected $fillable = [
        'title',
        'description',
        'tags',
        'category_id',
        'gaols_id',
        'cours_type',
        'isActive',
        'isComing',

    ];


     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tags' => 'array',
        'gaols_id' => 'array',
    ];


    /**
     * Get the category that owns the Cour
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class ,'category_id');
    }


    /**
     * Get the Goal that owns the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Goal(): BelongsTo
    {
        return $this->belongsTo(Goal::class, 'gaols_id');
    }


    /**
     * Get the CoursConference associated with the Cour
     *
     * @return HasOne
     */
    public function CoursConference(): HasOne
    {
        return $this->hasOne(CoursConference::class, 'cours_id');
    }

    /**
     * Get the CoursPodcast associated with the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function CoursPodcast(): HasOne
    {
        return $this->hasOne(CoursPodcast::class, 'cours_id');
    }

    /**
     * Get the CoursFormation associated with the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function CoursFormation(): HasOne
    {
        return $this->hasOne(CoursFormation::class, 'cours_id');
    }


    /**
     * Get all of the QuizSeccess for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function QuizSeccess(): HasMany
    {
        return $this->hasMany(QuizSeccess::class, 'cours_id');
    }

    /**
     * Get all of the QuestionAnswers for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function QuestionAnswers(): HasMany
    {
        return $this->hasMany(QuestionAnswers::class, 'cours_id');
    }

    /**
     * Get all of the QuizQuestion for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function QuizQuestion(): HasMany
    {
        return $this->hasMany(QuizQuestion::class, 'cours_id');
    }

    /**
     * Get all of the favoris for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoris(): HasMany
    {
        return $this->hasMany(CoursFavoris::class, 'cours_id');
    }

    /**
     * Get all of the comments for the Cour
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(CoursComment::class, 'cours_id');
    }

}
