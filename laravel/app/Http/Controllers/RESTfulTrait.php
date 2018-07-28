<?php

namespace App\Http\Controllers;

trait RESTfulTrait
{
    public function __construct()
    {
        $model = new $this->model();

        if (method_exists($model, 'trashed')) {
            $model = $model->withTrashed();
        }
        $this->model = $model;
    }

    public function index()
    {
        $models = $this->model
            ->filter(request()->all())
            ->when(request('with'), function ($q) {
                return $q->with(explode(',', request('with')));
            })
            ->paginate()
            ->appends(request()->all());
        return \Response::success($models);
    }

    public function show($id)
    {
        $model = $this->model->findOrFail($id);
        if (request('with')) {
            $model->load(explode(',', request('with')));
        }
        return \Response::success($model);
    }

    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);
        switch (request('ac')) {
            case 'force';
                $model->forceDelete();
                break;
            default:
                if (method_exists($model, 'trashed') && $model->trashed()) {
                    $model->restore();
                } else {
                    $model->delete();
                }
                break;
        }
        return \Response::success($model);
    }
}