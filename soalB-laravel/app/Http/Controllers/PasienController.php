<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\RumahSakit;

class PasienController extends Controller
{
    public function index()
    {
        $rs = RumahSakit::all();
        $pasiens = Pasien::with('rumahSakit')->paginate(10);
        return view('pasien.index', compact('pasiens','rs'));
    }

    public function create()
    {
        $rs = RumahSakit::all();
        return view('pasien.create', compact('rs'));
    }

    public function store(Request $r)
    {
        $r->validate(['nama'=>'required','rumah_sakit_id'=>'required']);
        Pasien::create($r->all());
        return redirect()->route('pasien.index')->with('success','Pasien ditambah');
    }

    public function edit($id)
    {
        $rs = RumahSakit::all();
        $p = Pasien::findOrFail($id);
        return view('pasien.edit', compact('p','rs'));
    }

    public function update(Request $r, $id)
    {
        $p = Pasien::findOrFail($id);
        $p->update($r->all());
        return redirect()->route('pasien.index')->with('success','Diupdate');
    }

    public function destroy($id)
    {
        Pasien::findOrFail($id)->delete();
        return redirect()->route('pasien.index')->with('success','Dihapus');
    }

    public function destroyAjax($id)
    {
        Pasien::findOrFail($id)->delete();
        return response()->json(['status'=>'success']);
    }

    public function filter(Request $request)
    {
        $id = $request->id;
        $query = Pasien::with('rumahSakit');

        if ($id) {
            $query->where('rumah_sakit_id', $id);
        }
        $data = $query->paginate(20);
        return response()->json($data);
    }
}
