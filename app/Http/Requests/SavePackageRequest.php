<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SavePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'event_type_id' => 'required',
            'name' => 'required',
            'minimum_pax' => 'required|numeric',
            'price' => 'required|numeric'
        ];
    }
}
