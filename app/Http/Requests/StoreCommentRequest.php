<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => 'required|max:50',
            'email' => 'required|email',
            'url' => 'nullable|url',
            'text' => 'required|max:500',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'file' => 'file|mimes:pdf,doc,docx|max:2048',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }
}
