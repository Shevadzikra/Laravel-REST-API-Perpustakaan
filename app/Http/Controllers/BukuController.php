<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
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
        $buku = Buku::all();
    
        // $data = $buku->map(function ($item) {
        //     $fotoPath = $item->image;
        //     return [
        //         'judul' => $item->judul,
        //         'kategori_id' => $item->kategori_id,
        //         'penulis' => $item->penulis,
        //         'penerbit' => $item->penerbit,
        //         'isbn' => $item->isbn,
        //         'tahun' => $item->tahun,
        //         'jumlah' => $item->jumlah,
        //         'image' => 'http://127.0.0.1:8000/storage/'.$fotoPath,
        //     ];
        // });
    
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditampilkan',
            'data' => $buku,
        ]);
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        /*
        $validatedData = $request->validate([
            'judul' => ['required'],
            'kategori_id' => ['required'],
            'penulis' => ['required'],
            'penerbit' => ['required'],
            'isbn' => ['required'],
            'tahun' => ['required'],
            'jumlah' => ['required'],
        ]);

        $uploadFolder = 'users';
        $image = $request->file('image');
        $image_path = $image->store($uploadFolder, 'public');
        */

        $buku = new Buku;

        

        $rules = [
            'judul' => 'required',
            'kategori_id' => 'required',
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
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

        $folderUpload = 'images';
        $foto = $foto = $request->file('image');
        $fotoPath = $foto->store($folderUpload, 'public');

        $fotoUrl = Storage::disk('public')->url($fotoPath);

        $buku->judul = $request->judul;
        $buku->kategori_id = $request->kategori_id;
        $buku->image = $fotoPath;
        $buku->image_url = $fotoUrl;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->isbn = $request->isbn;
        $buku->tahun = $request->tahun;
        $buku->jumlah = $request->jumlah;

        $buku->save();
    
        // Mengembalikan response JSON
        return response()->json([
            'status' => true,
            'message' => 'data berhasil dikirim',
            'data' => [
                'judul' => $buku->judul,
                'kategori_id' => $buku->kategori_id,
                'image' => $buku->image,
                'image_url' => $buku->image_url,
                'penulis' => $buku->penulis,
                'penerbit' => $buku->penerbit,
                'isbn' => $buku->isbn,
                'tahun' => $buku->tahun,
                'jumlah' => $buku->jumlah,
            ],
        ]);

        /*
        'id',
        'kategori_id',
        'judul',
        'penulis',
        'penerbit',
        'isbn',
        'tahun',
        'jumlah'
        */

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
        $buku = Buku::findOrFail($id);

        $rules = [
            'judul' => 'required',
            'kategori_id' => 'required',
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
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

        $folderUpload = 'images';
        $foto = $foto = $request->file('image');
        $fotoPath = $foto->store($folderUpload, 'public');

        $fotoUrl = Storage::disk('public')->url($fotoPath);

        $buku->judul = $request->judul;
        $buku->kategori_id = $request->kategori_id;
        $buku->image = $fotoPath;
        $buku->image_url = $fotoUrl;
        $buku->penulis = $request->penulis;
        $buku->penerbit = $request->penerbit;
        $buku->isbn = $request->isbn;
        $buku->tahun = $request->tahun;
        $buku->jumlah = $request->jumlah;

        $buku->save();

        return response()->json([
            'status' => true,
            'message' => 'data berhasil dikirim',
            'data' =>  $request
            ,
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
