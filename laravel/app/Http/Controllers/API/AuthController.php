<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\API\AuthRequest;

class AuthController extends Controller
{   
    use AuthenticatesUsers;

    /**
     * @OAS\Post(path="/login",tags={"Auth"},
        summary="login the system",description="",
     *  @OAS\RequestBody(required=true,description="",
     *     @OAS\MediaType(mediaType="application/json",
     *        @OAS\Items(ref="#/components/schemas/AuthRequest")
     *     )
     *  ),
     * @OAS\Response(response=200,description="successful operation"),
     * )
     **/
    public function login(AuthRequest $request)
    {
        $user = auth('web')->attempt($request->extractInputFromRules());
        if ($user) {
            return \Response::success(auth('web')->user());
        } else {
            return \Response::error('login error');
        }
    }
}
