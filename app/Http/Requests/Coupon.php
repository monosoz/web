<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class Coupon extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (false) {
            # code...
        } else {
            return true;
        }
        
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
