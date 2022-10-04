<?php

declare(strict_types=1);

namespace Companyservice\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'status'           => 'required|in:active,inactive',
            'package'          => 'required|min:3|max:600',
            'effective_time'   => 'required|min:3|max:50',
            'warranty'         => 'required|min:3|max:1000',
            'feature'          => 'required|min:3|max:600',
            'display_position' => 'required|min:3|max:600',
            'job_alert'        => 'required|min:3|max:600',
            're_top'           => 'required|min:3|max:300',
            'price'            => 'required|numeric'
        ]
        +
        ($this->isMethod('POST') ? $this->createRules() : $this->updateRules());
    }

    public function createRules(): array
    {
        return [
            'service_name' => 'required|unique:services,service_name|min:3|max:150'
        ];
    }

    public function updateRules(): array
    {
        return [
            'service_name' => 'required|min:3|max:120|unique:services,service_name,' . $this->service . ',id'
        ];
    }
}
