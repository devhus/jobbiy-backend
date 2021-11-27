<?php

namespace Modules\Company\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'location'    => 'required|string|max:100',
            'industry'    => 'required|string|max:100',
            'website'     => 'required|string|max:255',
            'type'        => 'required|string',
            'founded_at'  => 'required|date',
        ];
    }
}
