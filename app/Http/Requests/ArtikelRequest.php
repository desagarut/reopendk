<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArtikelRequest extends FormRequest
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
        // $gambarRule = $this->id ? 'nullable|' : 'required|';

        return [
            'judul'     => 'required|string|max:191',
            'isi'       => 'required',
            'status'    => 'required',
            'gambar'    => 'image|mimes:jpg,jpeg,png|max:2048|valid_file',
        ];
    }
}
