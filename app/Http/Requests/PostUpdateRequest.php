<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
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
        $rules= [
            'title' =>'required|min:3|max:255',
            'slug' =>'required|min:3|max:255|unique:posts,slug,'.$this->slug,
            // 'slug' =>'required|min:3|max:255',
            'status' =>'required',
            'category_id' =>'required',
            'sub_category_id' =>'required',
            'description' =>'required',
            'image' =>'nullable',
            'tag_ids' =>'required',
        ];
        return  $rules;
    }
}
