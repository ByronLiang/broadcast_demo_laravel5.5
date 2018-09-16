<?php

namespace App\Http\Controllers\Admin;

use Config;
use JSend;
use Illuminate\Http\Request;
// use App\Http\Requests\Admin\Request;
use App\Models\Catagory;
use App\Models\Author;
use App\Models\Product;
use App\Models\SampleFile;
use Illuminate\Support\Facades\Cache;
use GifCreator\GifCreator;
use App\Services\QiniuService;

class ProductController extends Controller
{
    public function getList(Request $request, Product $product)
    {
        // $data = Product::when(($request->isRecommend || $request->isRecommend == '0'), function ($q) use ($request) {
        //     return $q->where('recommend', $request->isRecommend);
        // })
        // ->when($request->catagory, function ($q) use ($request) {
        //     return $q->whereHas('catagories', function ($q1) use ($request) {
        //         $q1->where('catagory.id', $request->catagory);
        //     });
        // })
        // ->with('author', 'catagories')
        // ->paginate();
        // 对象获取
        $product = $product->filter($request);
        $data = $product->with('author', 'catagories')
            ->paginate();
        $catagories = Catagory::getCachedAll();

        return JSend::success(compact('data', 'catagories'));
    }

    public function getEdit($productId)
    {
        $product = Product::find($productId);

        return JSend::success($product);
    }

    public function getCatagory()
    {
        $catagory = Catagory::getCachedAll();

        return JSend::success($catagory);
    }

    public function getAuthor()
    {
        // 缓存加载作者选项
        $authors = Author::getCachedAll();

        return JSend::success($authors);
    }

    public function getSearch()
    {
        if (request('type') == 'catagory') {
            $data = Catagory::where('name', 'like', '%'.request('keyword').'%')
                ->select('id as value', 'name as label')
                ->get();
        } else if (request('type') == 'author') {
            $data = Author::where('name', 'like', '%'.request('keyword').'%')
                ->select('id as value', 'name as label')
                ->get();
        }

        return JSend::success($data);
    }

    public function postCreate(Request $request)
    {
        $product = Product::create([
            'name' => $request->name,
            'author_id' => $request->author_id,
            'recommend' => $request->recommend,
            'video' => $request->video,
            'type' => $request->type,
            'price' => $request->price,
            'video_poster' => count($request->video_poster) > 0 ? $request->video_poster : NULL,
        ]);
        $product->catagories()->sync($request->type);

        return JSend::success();
    }

    public function postUpdate(Request $request)
    {
        $product = Product::find($request->product_id);
        $product->update([
            'author_id' => $request->author_id,
            'video' => $request->video,
            'price' => $request->price,
            'type' => $request->type,
            'video_poster' => $request->video_poster,
            'recommend' => $request->recommend
        ]);
        $product->catagories()->sync($request->type);
        // SampleFile::create([
        //     'product_id' => $request->product_id,
        //     'sample_id' => 'z2.5b25e29ce3d00468089a6b6d',
        //     'sample_key' => 'sample_1529208658823.mp4',
        // ]);
        return JSend::success();
    }

    public function getShow($id)
    {
        $data = Product::with('catagories', 'author')
            ->findorFail($id);

        return JSend::success($data);
    }

    // 将资源合成gif并返回生成gif文件地址（考虑直接生成七牛）
    public function postCreateGif(Request $request)
    {
        $path = storage_path('app\create_gif_resource') . '/' . rand(1000, 9999).'_gif_picture.gif';
        $resources = json_decode($request->resource, true);
        if (count($resources) > 0) {
            $gc = new GifCreator();
            foreach ($resources as $value) {
                $durations[] = 60;
            }
            $gc->create($resources, $durations);
            $gifBinary = $gc->getGif();
            file_put_contents($path, $gifBinary);
            $qiniu = new QiniuService();
            $key = $qiniu->upload($path);
            $path = Config::get('filesystems.disks.qiniu')['domain'].$key;
            return JSend::success(compact('path'));
        } else {
            return JSend::error('无上传图片资源');
        }
    }
}
