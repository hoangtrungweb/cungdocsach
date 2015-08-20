<?php namespace App\Http\Requests\Site;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest {

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
            'title' => 'required|min:3',
            'description' => 'required|min:20',
            //'thumbnail' => 'required|mimes:jpeg,bmp,png,jpg|max:500kb',
             'thumbnail' => 'required',
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

}
