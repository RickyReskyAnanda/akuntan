<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProyekModel extends Model
{
    protected $table = "proyek";
    protected $primaryKey = "id_proyek";

    // public function getSoal(){
    // 	return $this->hasOne('App\Model\SoalModel','id_soal','id_soal');
    // }
    public function getJurnalUmum(){
    	return $this->hasMany('App\Model\JurnalUmumModel','id_proyek','id_proyek');
    }
}
