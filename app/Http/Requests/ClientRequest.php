<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
  /**
  * Determine if the user is authorized to make this request.
  *
  * @return bool
  */public function authorize()
  {
    if ($this->path() == '/') {
      return true;
    } else {
      return false;
    }
}

  /**
  * Get the validation rules that apply to the request.
  *
  * @return array
  */public function rules()
  {
    return [
      'family_name' => 'required',
      'first_name' => 'required',
      'gender' => 'required',
      'email' => 'required|email',
      'postcode' => ['required','regex:/^[0-9]{3}-[0-9]{4}$/'],
      'address' => 'required',
 /*     'building_name' => 'required', */
      'opinion' => 'required',
    ];
  }

  public function messages()
  {
    return [
      'family_name.required' => '姓を入力してください',
      'first_name.required' => '名を入力してください',
      'gender.required' => '性別を入力してください',
      'email.required' => 'メールアドレスを入力してください',
      'email.email' => 'メールアドレスの形式で入力してください',
      'postcode.required' => '郵便番号を入力してください',
      'address.required' => '住所を入力してください',
      'building_name.required' => '建物名を入力してください',
      'opinion.required' => 'ご意見を入力してください',
    ];
  }
}