<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return \true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           "title" => "required",
           "slug" => "required|min:3|max:255|unique:posts",
           "category_id" => "required",
           "sub_category_id" => "required",
           "description" => "required|min:20",
           "photo" => "required",
           "status" => "required",
           "tag_name_ids" => "required|array",
        ];
    }
}
