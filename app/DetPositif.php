<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetPositif extends Model
{
    protected $table = "tb_det_positif";

    protected $primaryKey = "id_det_positif";

    protected $fillable = ['id_det_positif','ic','tl','dirawat','sembuh','meninggal','jml_positif','wna','wni', 'id_positif'];
    public $timestamps = false;

   //  public function getCreatedAtAttribute() {
   //  return \Carbon\Carbon::parse($this->attributes['tgl'])
   //     ->format('d, M Y H:i');
   // }

   public function positif()
{
    return $this->belongsTo('App\Positif', 'id_positif');
}



}




