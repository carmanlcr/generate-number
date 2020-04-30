<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rrss_id' => 'required|numeric',
            'campaings_id' => 'required|numeric',
            'generes_id' => 'required|numeric',
            'date_publication' => 'required|date',
            'phrase' => 'required',
            'image' => 'file',
            'quantity_min' => 'numeric'.
        ];
    }
}
