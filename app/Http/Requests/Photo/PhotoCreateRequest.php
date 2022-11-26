<?php

namespace App\Http\Requests\Photo;

use Illuminate\Foundation\Http\FormRequest;

class PhotoCreateRequest extends FormRequest
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
            'title' =>'required|max:255',
            'album_id' =>'required|integer',
            'price' =>'required',
            'description' =>'required|max:255',
            'photo' => 'required|mimes:png,jpg,jpeg',
            'capture_date' =>'required|date',
        ];
    }
}
