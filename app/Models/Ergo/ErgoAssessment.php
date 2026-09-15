<?php

namespace App\Models\Ergo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ErgoAssessment extends Model
{
    use HasFactory;
    protected $table = 'ergo_assessments';
    protected $guarded = ['id'];

    public function company()
    {
        return $this->belongsTo(ErgoCompany::class, 'company_id');
    }

    public function workers()
    {
        return $this->hasMany(ErgoWorker::class, 'assessment_id');
    }
}