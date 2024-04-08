<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizQuestion extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'cours_id',
        'Question',
    ];


    /**
     * Get all of the QuizQuestion for the QuizQuestion
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function QuestionAnswers(): HasMany
    {
        return $this->hasMany(QuestionAnswers::class, 'question_id');
    }

    /**
     * Get the cours that owns the QuizQuestion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cours(): BelongsTo
    {
        return $this->belongsTo(Cour::class, 'cours_id');
    }


}
