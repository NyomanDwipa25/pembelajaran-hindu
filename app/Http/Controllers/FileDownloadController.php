<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function download($type, $filename)
    {
        $path = $type . '/' . $filename;
        $disk = Storage::disk('public');

        if (!$disk->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        return $disk->download($path, $filename, [
            'Content-Type' => 'application/octet-stream',
        ]);
    }
}
