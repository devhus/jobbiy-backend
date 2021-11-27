<?php

namespace Modules\Job\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'location'    => 'required|string|max:56',
            'enabled'     => 'nullable|boolean',
        ];
    }
}
