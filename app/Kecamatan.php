<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    public $timestamps = false;

	protected $table = "tb_kecamatan";

    protected $primaryKey = "id_kecamatan";

    protected $fillable = ['id_kecamatan','nama_kecamatan', 'id_kabupaten'];

    public function kabupaten()
{
    return $this->belongsTo('App\Kabupaten', 'id_kabupaten');
}

	public function kelurahan()
    {
        return $this->hasMany('App\Kelurahan', 'id_kelurahan');
    }

}
