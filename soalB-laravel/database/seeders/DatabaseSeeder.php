<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\RumahSakit;
use App\Models\Pasien;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'username' => 'admin',
            'password' => bcrypt('admin123'),
        ]);

        $rs1 = RumahSakit::create([
            'nama' => 'RS Harapan',
            'alamat' => 'Jakarta',
            'email' => 'contact@harapan.id',
            'telepon' => '021-111111'
        ]);

        $rs2 = RumahSakit::create([
            'nama' => 'RS Sehat',
            'alamat' => 'Bandung',
            'email' => 'contact@sehat.id',
            'telepon' => '022-222222'
        ]);

        Pasien::create(['nama'=>'Budi','alamat'=>'Jakarta','telepon'=>'081111','rumah_sakit_id'=>$rs1->id]);
        Pasien::create(['nama'=>'Siti','alamat'=>'Jakarta','telepon'=>'082222','rumah_sakit_id'=>$rs1->id]);
        Pasien::create(['nama'=>'Andi','alamat'=>'Bandung','telepon'=>'083333','rumah_sakit_id'=>$rs2->id]);
    }
}
