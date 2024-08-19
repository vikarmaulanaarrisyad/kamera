<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Category;
use App\Models\Carts;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index($id = null) {

        if($id != null) {
            $alats = Alat::where('kategori_id','=',$id)->get();
        }
        else {
            $alats = Alat::with(['category'])->get();
        }

        if(request('search')) {
            $key = request('search');
            $alats =  Alat::with(['category'])->where('nama_alat','LIKE','%'.$key.'%')->get();
        }

        return view('admin.alat.alat',[
            'alats' => $alats,
            'categories' => Category::all()
        ]);
    }

    public function edit($id) {
        $alat = Alat::with(['category'])->find($id);

        return view('admin.alat.editalat',[
            'alat' => $alat,
            'kategori' => Category::all()
        ]);
    }

    public function store(Request $request) {
        $this->validate($request,[
            'nama' => 'required',
            'kategori' => 'required',
            'paket1' => 'required|numeric',
            'paket2' => 'required|numeric',
            'paket3' => 'required|numeric',
            'paket4' => 'required|numeric',
            'gambar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $alat = new Alat();
        $alat->nama_alat = $request['nama'];
        $alat->deskripsi = $request['deskripsi'];
        $alat->kategori_id = $request['kategori'];
        $alat->paket4 = $request['paket4'];
        $alat->paket3 = $request['paket3'];
        $alat->paket2 = $request['paket2'];
        $alat->paket1 = $request['paket1'];

        if($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time().'-'.$gambar->getClientOriginalName();
            $gambar->move(public_path('images'), $filename);
            $alat->gambar = $filename;
        }

        $alat->save();

        return redirect(route('alat.index'))->with('message', 'Produk berhasil ditambah!');
    }

    public function update(Request $request, $id) {
        $this->validate($request,[
            'nama' => 'required',
            'kategori' => 'required',
            'paket1' => 'required|numeric',
            'paket2' => 'required|numeric',
            'paket3' => 'required|numeric',
            'paket4' => 'required|numeric',
            'gambar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ]);

        $alat = Alat::find($id);
        $alat->nama_alat = $request['nama'];
        $alat->deskripsi = $request['deskripsi'];
        $alat->kategori_id = $request['kategori'];
        $alat->paket4 = $request['paket4'];
        $alat->paket3 = $request['paket3'];
        $alat->paket2 = $request['paket2'];
        $alat->paket1 = $request['paket1'];

        if($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $filename = time().'-'.$gambar->getClientOriginalName();
            $gambar->move(public_path('images'), $filename);
            $alat->gambar = $filename;
        }

        $alat->save();

       

        return redirect(route('alat.index'))->with('message', 'Produk berhasil diperbarui!');
    }

    public function destroy($id) {
        $alat = Alat::find($id);

        if($alat->gambar != 'noimage.jpg') {
            $filepath = public_path('images'). '/' . $alat->gambar;
            unlink($filepath);
        }

        // Agar 'total' dalam Payment berkurang jika alat dihapus
        $payment = new Payment();
        $order = Order::where('alat_id', $id)->get();
        foreach($order as $o) {
            $payment->where('id', $o->payment_id)->decrement('total', $o->harga);
        }

        $alat->delete();
        return redirect(route('alat.index'))->with('message', 'Produk berhasil dihapus!');
    }
}
