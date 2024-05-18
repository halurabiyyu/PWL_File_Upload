<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadImageController extends Controller
{
    public function form_index() {
        return view('form');
    }

    public function prosesUpload(Request $request) {
        $request->validate([
            'nama' => 'required|string|min:5',
            'gambar' => 'required|file|image|max:50000'
        ]);

        $namaFile = $request->nama . '.' . $request->gambar->getClientOriginalExtension();
        $path = $request->gambar->move('gambar', $namaFile);
        $path = str_replace("\\","//",$path);
        return view('show-file', [
            'oldName' => $request->gambar->getClientOriginalName(), 
            'newName' => $namaFile, 
            'extension' => $request->gambar->getClientOriginalExtension(),
            'path' => $path, 
        ]);
    }
}