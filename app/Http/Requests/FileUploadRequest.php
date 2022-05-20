<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

class FileUploadRequest extends FormRequest
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
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:10240'
        ];
    }

    public function messages()
    {
        return [
            'file.required' => 'A file is required',
            'file.mimes'  => 'Accepted file types: csv,txt,xlx,xls,pdf',
            'file.max'  => 'The document must not be greater than 10 megabytes',
         ];
    }


    protected function failedValidation(Validator $validator)
    {
        $response = new Response([
            "success" => false,
            "message" => "File upload failed.",
            'errors' => $validator->errors()
        ], 422);
        throw new ValidationException($validator, $response);
    }
}