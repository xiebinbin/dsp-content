<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends AdminController
{
    public function uploadByUrl(Request $request) {
        $url = $request->input('url','');
        if (strpos($url, config('filesystems.disks.doge.url'))) {
            $aurl = parse_url($url, PHP_URL_PATH);
            $ext = pathinfo($aurl, PATHINFO_EXTENSION);
            $fileName = 'posts/images/'.md5($url) . '.' . $ext;
            Storage::disk('doge')->put($fileName, file_get_contents($url));
            $url = Storage::disk('doge')->url($fileName);
        }
    
        return response()->json([
            'success' => true,
            'file' => [
                'url' => $url
            ],
        ]);
    }
    public function uploadByFile(Request $request) {
        $path = $request->file('file')->store('posts/images', 'doge');
        $url = Storage::disk('doge')->url($path);
        return response()->json([
            'success' => true,
            'file' => [
                'url' => $url,
            ],
        ]);
    }
}
