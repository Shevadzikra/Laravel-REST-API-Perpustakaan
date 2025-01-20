<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buku = Buku::get();
        return response()->json($buku);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $buku = new Buku;

        $buku->judul = $request->judul;
        $buku->kategori_id = $request->kategori_id;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->isbn = $request->isbn;
        $buku->tahun = $request->tahun;
        $buku->jumlah = $request->jumlah;

        $buku->save();
    
        // Mengembalikan response JSON
        return response()->json($buku);

    //     'id',
    //     'kategori_id',
    //     'judul',
    //     'penulis',
    //     'penerbit',
    //     'isbn',
    //     'tahun',
    //     'jumlah'
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return response()->json($buku);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $buku->judul = $request->judul;
        $buku->kategori_id = $request->kategori_id;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->isbn = $request->isbn;
        $buku->tahun = $request->tahun;
        $buku->jumlah = $request->jumlah;

        $buku->save();
        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();

        return response()->json($buku);
    }
}
