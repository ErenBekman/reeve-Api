<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAddNewRequest extends FormRequest
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
        //dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
        return [
            // 'image' => 'image|mimes:jpg,png,jpeg,gif,svg',
            'author' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'content' => 'required'
        ];
    }

    public function messages()
{
    return [
        'author.required' => 'Yazar Alanı Gereklidir.',
        'title.required' => 'Başlık Alanı Gereklidir.',
        'content.required' => 'Mesaj Alanı Gereklidir.',
    ];
}
}
