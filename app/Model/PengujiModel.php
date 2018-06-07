<?php

namespace App\Model;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PengujiModel extends Authenticatable
{
    use Notifiable;

    protected $table = 'penguji';
    protected $primaryKey = 'id_penguji';

    protected $guard = 'penguji';

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function jumlahDataMahasiswaJaringan(){
        return $this->hasMany('App\User','id_penguji_jaringan','id_penguji');
    }
    public function jumlahDataMahasiswaRPL(){
        return $this->hasMany('App\User','id_penguji_rpl','id_penguji');
    }
    public function jumlahDataMahasiswaAgama(){
        return $this->hasMany('App\User','id_penguji_agama','id_penguji');
    }
}
