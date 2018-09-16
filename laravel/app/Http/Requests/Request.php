<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function extractInputFromRules()
    {
        if (! method_exists($this, 'rules')) {
            return $this->all();
        }
        $rules = $this->rules();

        return $this->only(collect($rules)->keys()->map(function ($rule) {
            return \Illuminate\Support\Str::contains($rule, '.') ? explode('.', $rule)[0] : $rule;
        })->unique()->toArray());
    }
}
