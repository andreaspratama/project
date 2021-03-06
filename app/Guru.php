<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $fillable = [
        'email', 'nama', 'user_id', 'ttd'
    ];

    protected $hidden = [];

    public function mapel()
    {
        return $this->belongsToMany(Mapel::class)->withPivot(['ruang', 'kelas', 'hari', 'jam_mulai', 'jam_selesai']);
    }

    public function jadwalmapel()
    {
        return $this->hasMany(Jadwalmapel::class);
    }

    public function pg()
    {
        return $this->hasMany('App\Penilaianguru');
    }
}
