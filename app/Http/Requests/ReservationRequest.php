<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => 'required|date',
            'time' => 'required',
            'pickup' => 'required',
            'pickup_number' => 'required',
            'dropoff' => 'required',
            'adults' => 'required|numeric',
            'type_service' => 'required',
            'service_color' => 'required',
            'rate' => 'required|numeric',
            'customer_name' => 'required',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
        ];
    }
}
