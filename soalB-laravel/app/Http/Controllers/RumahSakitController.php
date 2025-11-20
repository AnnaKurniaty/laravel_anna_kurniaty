<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\RumahSakit;

class RumahSakitController extends Controller
{
    public function index()
    {
        $data = RumahSakit::paginate(10);
        return view('rumahsakit.index', compact('data'));
    }

    public function create(){ return view('rumahsakit.create'); }

    public function store(Request $r)
    {
        $r->validate(['nama'=>'required']);
        RumahSakit::create($r->all());
        return redirect()->route('rumahsakit.index')->with('success','Berhasil ditambah');
    }

    public function edit($id){
        $item = RumahSakit::findOrFail($id);
        return view('rumahsakit.edit', compact('item'));
    }

    public function update(Request $r, $id){
        $rs = RumahSakit::findOrFail($id);
        $rs->update($r->all());
        return redirect()->route('rumahsakit.index')->with('success','Diupdate');
    }

    public function destroy($id){
        RumahSakit::findOrFail($id)->delete();
        return redirect()->route('rumahsakit.index')->with('success','Dihapus');
    }
}
