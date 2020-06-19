<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    public $timestamps = false;

	protected $table = "tb_kelurahan";

    protected $primaryKey = "id_kelurahan";

    protected $fillable = ['id_kelurahan','nama_kelurahan', 'id_kecamatan'];

    public function kecamatan()
{
    return $this->belongsTo('App\Kecamatan', 'id_kecamatan');
}

	public function positif()
    {
        return $this->hasMany('App\Positif', 'id_positif');
    }

}
