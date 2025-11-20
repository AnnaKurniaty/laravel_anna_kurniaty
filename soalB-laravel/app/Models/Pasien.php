<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = ['nama','alamat','telepon','rumah_sakit_id'];

    public function rumahSakit()
    {
        return $this->belongsTo(RumahSakit::class);
    }
}
