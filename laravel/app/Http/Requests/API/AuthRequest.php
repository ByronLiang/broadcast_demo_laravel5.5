<?php

namespace App\Http\Requests\API;

/**
 *  @OAS\Schema(type="object",required={"phone","password"},
 *      @OAS\Property(property="phone",type="string",description="phone",example=""),
 *      @OAS\Property(property="password",type="string",description="password",example=""),
 *  )
 */
class AuthRequest extends Request
{
    public function rules()
    {
        return [
            'phone' => 'required',
            'password' => 'required',
        ];
    }
}
