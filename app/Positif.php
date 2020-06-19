<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Positif extends Model
{
    protected $table = "tb_positif";

    protected $primaryKey = "id_positif";

    protected $fillable = ['id_positif','id_kelurahan','tgl','level','ppln','ppdn','tl','lainnya','total','dirawat','sembuh','meninggal','jml_positif'];
    public $timestamps = false;

   //  public function getCreatedAtAttribute() {
   //  return \Carbon\Carbon::parse($this->attributes['tgl'])
   //     ->format('d, M Y H:i');
   // }

   

    public function kelurahan()
{
    return $this->belongsTo('App\Kelurahan', 'id_kelurahan');
}



}