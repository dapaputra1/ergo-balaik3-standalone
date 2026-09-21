<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErgoAssessment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relasi ke tabel foto multi-upload
    public function photos()
    {
        return $this->hasMany(ErgoAssessmentPhoto::class, 'ergo_assessment_id');
    }

    public function gotrakDetails()
    {
        return $this->hasMany(ErgoGotrakDetail::class, 'ergo_assessment_id');
    }

    public function checklistScores()
    {
        return $this->hasMany(ErgoChecklistScore::class, 'ergo_assessment_id');
    }

    public function injuries()
    {
        return $this->hasMany(ErgoInjury::class, 'ergo_assessment_id');
    }
}