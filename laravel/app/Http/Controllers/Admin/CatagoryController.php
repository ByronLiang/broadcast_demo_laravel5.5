<?php

namespace App\Http\Controllers\Admin;

use JSend;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CatagoryRequest;
use App\Models\Catagory;

class CatagoryController extends Controller
{
    public function getList()
    {
        $model = Catagory::paginate(5);

        return JSend::success($model);
    }

    public function getAllDatas()
    {
        $model = Catagory::select('id', 'number', 'name')->get();

        return JSend::success($model);
    }

    public function getShow($id)
    {
        $model = Catagory::findOrFail($id);

        return JSend::success($model);
    }

    public function postCreate(CatagoryRequest $request)
    {
        $cata = Catagory::create($request->getData());
        if ($cata) {
            return JSend::success();
        }
    }

    public function postUpdate(CatagoryRequest $request)
    {
        Catagory::find($request->banner_id)
            ->update($request->getData());

        return JSend::success();
    }

    public function getDestroy($id)
    {
        Catagory::find($id)->delete();

        return JSend::success();
    }

    public function postUpdateOrder(Request $request)
    {
        $datas = $request->all();
        foreach ($datas as $value) {
            Catagory::find($value['id'])->update([
                'number' => $value['number'],
            ]);
        }

        return JSend::success();
    }
}
