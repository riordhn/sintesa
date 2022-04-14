<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evaluation extends Model
{
    use SoftDeletes;

    protected $table = 'evaluations';

    protected $primaryKey = 'evaluation_id';

    public $incrementing = true;

    protected $fillable = [
        'created_by',
        'updated_by',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
        'created_by',
        'updated_by',
    ];

    public function getCreatedAtAttribute($value){
        return date_format(date_create($value), 'd M Y H:i');
    }
    
    // public function getStudyCertificateAttribute($value){
    //     if(!empty($value))
    //         return url($value);
    //     else
    //         return null;
    // }

    // public function getStudySemesterResultAttribute($value){
    //     if(!empty($value))
    //         return url($value);
    //     else
    //         return null;
    // }

    // public function getStudyPresencetAttribute($value){
    //     if(!empty($value))
    //         return url($value);
    //     else
    //         return null;
    // }

    // public function getProposalFileAttribute($value){
    //     if(!empty($value))
    //         return url($value);
    //     else
    //         return null;
    // }

    // public function getSimilarityFileAttribute($value){
    //     if(!empty($value))
    //         return url($value);
    //     else
    //         return null;
    // }

    // public function getEndTestFileAttribute($value){
    //     if(!empty($value))
    //         return url($value);
    //     else
    //         return null;
    // }

    public function scopeByUser($query, $user_id){
        return $query->where('NIK', $user_id);
    }

    public function studyStatusToText(){
        switch($this->study_status){
            case 1: return 'Sudah Selesai'; break;
            case 2: return 'Belum Selesai'; break;
            default: return ''; break;
        }
    }

    public function hasProposalTestToText(){
        switch($this->has_proposal_test){
            case 1: return 'Sudah'; break;
            case 2: return 'Belum'; break;
            default: return ''; break;
        }
    }

    public function hasSimilarityTestToText(){
        switch($this->has_similarity_test){
            case 1: return 'Sudah'; break;
            case 2: return 'Belum'; break;
            default: return ''; break;
        }
    }
}
