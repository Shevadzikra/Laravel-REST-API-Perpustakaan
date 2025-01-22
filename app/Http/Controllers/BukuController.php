<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Response;

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

        // $validatedData = $request->validate([
        //     'judul' => ['required'],
        //     'kategori_id' => ['required'],
        //     'penulis' => ['required'],
        //     'penerbit' => ['required'],
        //     'isbn' => ['required'],
        //     'tahun' => ['required'],
        //     'jumlah' => ['required'],
        // ]);

        $buku = new Buku;

        $rules = [
            'judul' => 'required',
            'kategori_id' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'isbn' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'data gagal dikirim',
                'data' => $validator->errors()
            ]);
        }

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
        $buku = Buku::find($id);
        if ($buku) {
            return response()->json([
                'status' => true,
                'message' => 'data berhasil ditampilkan',
                'data' => $buku
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data gagal ditampilkan',
            ]);
        }
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
        // $validatedData = $request->validate([
        //     'title' => ['required', 'unique:posts', 'max:255'],
        //     'body' => ['required'],
        // ]);
        $buku = Buku::findOrFail($id);

        $rules = [
            'judul' => 'required',
            'kategori_id' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'isbn' => 'required',
            'tahun' => 'required',
            'jumlah' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'data gagal diperbarui',
                'data' => $validator->errors()
            ]);
        }

        $buku->judul = $request->judul;
        $buku->kategori_id = $request->kategori_id;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->isbn = $request->isbn;
        $buku->tahun = $request->tahun;
        $buku->jumlah = $request->jumlah;

        $buku->save();
        return response()->json([
            'status' => true,
            'message' => 'data berhasil diperbarui',
            'data' => $request
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        if ($buku) {
            return response()->json([
                'status' => true,
                'message' => 'data berhasil dihapus',
                'data' => $buku
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data gagal dihapus',
            ]);
        }

    }
}
