<?php

namespace App\Http\Requests;

use App\Models\DataLembaga;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DataLembagaUpdateRequest extends FormRequest
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
        $dataLembaga = optional($this->user()->dataLembaga);
        $ignoreId = $dataLembaga->id ?? null;

        return [
            // NPSN tidak unik (bisa sama antar anggota dari lembaga yang sama)
            'npsn' => [
                'required',
                'string',
                'max:8',
            ],
            'nama_lembaga' => ['required', 'string', 'max:255'],
            'alamat_lembaga' => ['required', 'string'],
            'kelurahan' => ['required', Rule::in(DataLembaga::getKelurahanOptions())],
            'kecamatan' => ['nullable', 'string', 'max:255'],
            'kota' => ['nullable', 'string', 'max:255'],
            'no_telp_lembaga' => ['nullable', 'string', 'max:15'],
            'email_lembaga' => ['nullable', 'email', 'max:255'],
        ];
    }
}
