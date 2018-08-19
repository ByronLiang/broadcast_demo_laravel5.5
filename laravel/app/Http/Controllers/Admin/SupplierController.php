<?php

namespace App\Http\Controllers\Admin;

use Ganguo\ClientAggregationUpload\ClientAggregationUpload;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function getUpload()
    {
        // $drive = request('drive', 'local');
        $drive = request('drive', 'qiniu');
        $data = (new ClientAggregationUpload())->getParameter($drive);

        return \JSend::success($data);
    }

    public function postUpload(\Illuminate\Http\Request $request)
    {
        $data = (new ClientAggregationUpload())->local($request);

        return \JSend::success([$data]);
    }

    public function postNormal(Request $request)
    {
        $file = $request->file('file');

        if ($file && !$file->isValid()) {
            return abort(422, '上传失败');
        }
        $file->move('upload', $request->key);
        $data = ['key' => $request->key];

        return \JSend::success($data);

        // return response()->json([
        //     'key' => $request->key,
        // ]);
    }
}
