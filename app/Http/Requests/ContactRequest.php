<?php

namespace App\Http\Requests;

use App\Rules\UsPhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $uniquePhoneNumber = $this->id ==null ?['unique:contacts,phone_number']: ['unique:contacts,phone_number,'. $this->id. ',id'];
        return [
            "name" => 'required|max:255',
            "phoneNumber" => array_merge($uniquePhoneNumber, [
                'required',

                'regex:/^(\+1\s?)?(\()?(\d{3})(?(2)\))[-.\s]?(\d{3})[-.\s]?(\d{4})$/'
            ]),
            "image" => "nullable|image|mimes:jpg,jpeg,png"
        ];
    }
}
