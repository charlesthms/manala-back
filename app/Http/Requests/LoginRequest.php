<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    return [
      'email' => 'email|required|string|max:255|exists:users',
      'password' => 'required',
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages(): array
  {
    return [
      'email.required' => 'Veuillez saisir votre adresse email.',
      'email.email' => 'Veuillez saisir une adresse email valide.',
      'email.string' => 'Veuillez saisir une adresse email valide.',
      'email.max' => 'Veuillez saisir une adresse email valide.',
      'email.exists' => 'Cette adresse e-mail n\'existe pas.',
      'password.required' => 'Veuillez saisir votre mot de passe.',
    ];
  }
}
