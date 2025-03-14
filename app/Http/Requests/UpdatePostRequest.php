<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
        return [
           'title' => ['required', 'min:3', 'unique:posts,title,' . $this->post->id],
            'description'=>['required','min:10'],
            'image'=>['nullable','image','mimes:jpg,png'],
            'user_id'=>['required','exists:users,id']

        ];
    }
}
