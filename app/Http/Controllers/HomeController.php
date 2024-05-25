<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        return view('welcome');
    }

    public function getData(){
        $data = DB::table('transaksi')
            ->join('users', 'users.id', 'transaksi.user_id')
            ->join('barang', 'barang.barang_id', 'transaksi.barang_id')
            ->join('kategori', 'kategori.kategori_id', 'barang.kategori_id')
            ->select('users.name', 'kategori.nama_kategori', 'barang.nama_barang', 'transaksi.kuantitas', 'transaksi.harga_satuan', 'transaksi.sub_total')
            ->get();
            return response()->json($data);
    }
}
