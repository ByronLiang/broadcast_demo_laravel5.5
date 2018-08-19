<?php

namespace App\Http\Controllers\Admin;

use JSend;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Product;

class BannerController extends Controller
{
    public function getList()
    {
        $banners = Banner::get();

        return \JSend::success($banners);
    }

    public function getShow($bannerId)
    {
        $banner = Banner::findOrFail($bannerId);
        // $banner['picture'] = [
        //     'url'  => $banner['picture'],
        //     'size' => $banner['size'],
        // ];
        $product = [];
        // if ($banner->resource) {
        //     $product = Product::findOrFail($banner->resource);
        // }

        return \JSend::success(compact('banner', 'product'));
    }

    public function postCreate(Request $request)
    {
        $picture = $request->picture;
        $banner = Banner::create([
            'picture' => $picture,
            'url' => $picture['url'],
            'status' => $request->status,
            'size' => $picture['size'],
            'type' => $request->type,
            'video_poster' => $request->video_poster,
        ]);

        if ($banner) {
            return JSend::success($banner);
        } else {
            return JSend::error('error!');
        }
    }

    public function getJumpOptions()
    {
        $model = Product::select('id', 'video as url', 'name')->get();

        return JSend::success($model);
    }
}
