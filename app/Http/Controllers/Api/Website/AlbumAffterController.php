<?php

namespace App\Http\Controllers\Api\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\website\AlbumAffter;

class AlbumAffterController extends Controller
{
    public function createOrUpdateAlbumAffter(Request $request)
    {
        $items = $request->data ?? [];

        AlbumAffter::truncate();

        foreach ($items as $sort => $item) {
            AlbumAffter::create([
                'before' => $item['before'] ?? '',
                'after'  => $item['after']  ?? '',
                'title'  => $item['title']  ?? '',
                'status' => $item['status'] ?? 1,
                'sort'   => $item['sort']   ?? $sort,
            ]);
        }

        return response()->json(['message' => 'success'], 200);
    }

    public function listAlbumAfftero()
    {
        $data = AlbumAffter::orderBy('sort')->orderBy('id')->get();

        return response()->json([
            'message' => 'success',
            'data'    => $data,
        ], 200);
    }
}
