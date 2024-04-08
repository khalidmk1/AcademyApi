<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Answer  extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'Question_id',
        'Answer'
    ];

    /**
     * Get the question that owns the Answer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class, 'Question_id');
    }
    
    /**
     * Get the QuizSeccess associated with the Answer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function QuizSeccess(): HasOne
    {
        return $this->hasOne(QuizSeccess::class, 'answer_id');
    }
    
}
