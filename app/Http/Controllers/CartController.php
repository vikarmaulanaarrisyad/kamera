<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Carts;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function store(Request $request, $id, $userId) {
        $cart = new Carts();
        $alat = Alat::find($id);

        if($request['btn'] == '4') {
            $harga = $alat->paket4;
        }
        if($request['btn'] == '3') {
            $harga = $alat->paket3;
        }
        if($request['btn'] == '2') {
            $harga = $alat->paket2;
        }
        if($request['btn'] == '1') {
            $harga = $alat->paket1;
        }

        $cart->user_id = $userId;
        $cart->alat_id = $alat->id;
        $cart->harga = $harga;
        $cart->paket = $request['btn'];

        $cart->save();

        return back()->with('success', 'Berhasil ditambahkan ke keranjang');
    }

    public function destroy($id) {
        $alat = Carts::find($id);
        $alat->delete();

        return back();
    }
}
