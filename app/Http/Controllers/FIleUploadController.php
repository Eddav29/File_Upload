<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload()
    {
        return view('file-upload');
    }

    public function prosesFileUpload(Request $request)
    {
        // Handle the file upload logic here
        //dump($request->berkas);
        
        // if ($request->hasFile('berkas')) {
        //     echo "path(): ".$request->berkas->path();
        //     echo "<br>";
        //     echo "extension(): ".$request->berkas->extension();
        //     echo "<br>";
        //     echo "getClientOriginalExtension(): ".
        //     $request->berkas->getClientOriginalExtension();
        //     echo "<br>";
        //     echo "getMimeType(): ".$request->berkas->getMimeType();
        //     echo "<br>";
        //     echo "getClientOriginalName(): ".$request->berkas->getClientOriginalName();
        //     echo "<br>";
        //     echo "getSize(): ".$request->berkas->getSize();
        // } else {
        //     echo "Tidak ada berkas yang diupload";
        // }

        $request->validate([
            'berkas' =>'required|file|image|max:500',
        ]);
        $extFile = $request->berkas->getClientOriginalName();
        $namaFile = 'web-'.time().".".$extFile;
        
        $path = $request->berkas->move('gambar',$namaFile);
        $path = str_replace("\\","//",$path);
        echo "Variabel path berisi : $path <br>";

        $pathBaru = asset('gambar/'.$namaFile);
        echo "Proses Upload Berhasil, file berada di : ". $path;
        echo "<br>";
        echo "Tampilkan Link : <a href='$pathBaru'> $pathBaru </a> ";
        // echo $request->berkas->getClientOriginalName()."lolos Validasi";
    }
}
