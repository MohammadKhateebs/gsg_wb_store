<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        //return the id frome route parameter
        $id=$this->route('id');

        return [
                  // 'name of input '=>'Condtion',
            //if use parameter use :
            // 'name' => 'required|string|max:255|unique:categories,name,'.$id,
            'name' => [
                'required',
                'string',
                'max:255',
                // 'unique:categories,name,'.$id,
                Rule::unique('categories', 'name')->ignore($id, 'id'),
                // (new Unique('categories','name'))->ignore($id,'id'),

            ],
            //exists : use to check if data exite in table

            'parent_id' => 'nullable |int|exists:categories,id',
            'description' => 'nullable|string|min:5',
            'image' => 'nullable|mimes:jpg,png,jpeg', //kb
        ];
    }
    //To Carete a Custom message use method that name
    //messages() its Mandatory!
    public function messages(){
        return [
            'name.required'=>':attribute Requierd !',

        ];
    }
}
