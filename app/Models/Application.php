<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use App\Models\Education;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','phone','division','district','upazila','address','language','images','cv','training','exam_name','university','boards','results','training_name','details'
    ];


    public function divisions()
    {
        return $this->belongsTo(Division::class,'division','id');
    }
    public function districts()
    {
        return $this->belongsTo(District::class,'district','id');
    }
    public function upazilas()
    {
        return $this->belongsTo(Upazila::class,'upazila','id');
    }
    public function educations()
    {
        return $this->hasMany(Education::class,'application_id','id');
    }

}
