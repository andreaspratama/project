<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwalmapel extends Model
{
    protected $fillable = [
        'guru_id', 'unit', 'kelas'
    ];

    protected $hidden = [];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }
}
