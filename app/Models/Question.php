<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'question',
    ];

     /**
     * Get all of the Answers for the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function Answers(): HasMany
    {
        return $this->hasMany(Answer::class, 'Question_id');
    }

    /**
     * Get the QuizSeccess associated with the Question
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function QuizSeccess(): HasOne
    {
        return $this->hasOne(QuizSeccess::class, 'question_id');
    }

}
