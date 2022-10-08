<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ExamList;
use App\Models\Board;
use App\Models\UniversityList;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id','exam_name','university','boards','results'
    ];

    public function exams()
    {
        return $this->belongsTo(ExamList::class,'exam_name','id');
    }
    public function university()
    {
        return $this->belongsTo(UniversityList::class,'university','id');
    }

    public function boards()
    {
        return $this->belongsTo(Board::class,'boards','id');
    }
}
