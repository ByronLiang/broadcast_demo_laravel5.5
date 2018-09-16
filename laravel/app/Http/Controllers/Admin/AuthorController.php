<?php

namespace App\Http\Controllers\Admin;

use JSend;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    public function getList()
    {
        $perPage = request('perPage') ?? 5;
        $datas = Author::paginate($perPage)
            ->appends(request()->all());

        return JSend::success($datas);
    }

    public function postCreate(Request $request)
    {
        $author = Author::create([
            'name' => $request->name,
            'avatar' => $request->avatar,
            'introduction' => $request->introduction,
        ]);
        if ($request->is_open_chatroom == 'yes') {
            $author->room()->create($request->options);
        }

        return JSend::success();
    }

    public function getEdit(Request $request)
    {
        $data = Author::with('room')->find($request->id);

        return JSend::success($data);
    }

    public function putUpdate(Request $request)
    {
        $author = Author::with('room')->find($request->id);
        $author->update([
            'name' => $request->name,
            'avatar' => $request->avatar,
            'introduction' => $request->introduction
        ]);
        if ($request->is_open_chatroom == 'yes') {
            if ($author->room) {
                $author->room()->update($request->options);
            } else {
                $author->room()->create($request->options);
            }
        } else if ($request->is_open_chatroom == 'no') {
            $author->room()->delete();
        }

        return JSend::success();
    }

    public function getDestroy($id)
    {
        Author::find($id)->delete();

        return JSend::success();
    }
}
