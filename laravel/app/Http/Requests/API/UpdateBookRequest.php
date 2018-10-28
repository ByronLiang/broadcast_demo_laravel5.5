<?php

namespace App\Http\Requests\API;

/**
 *  @OAS\Schema(type="object",required={"title"},
 *       @OAS\Property(property="title",type="string",description="内容",example=""),
 *  )
 */
class UpdateBookRequest extends Request
{
    public function rules()
    {
        return [
            'title' => 'required',
        ];
    }
}
