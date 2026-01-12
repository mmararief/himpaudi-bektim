<?php

namespace App\Http\Requests;

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
            'jabatan' => ['nullable', 'string', 'max:100'],
            'kelurahan' => ['nullable', 'in:Aren Jaya,Bekasi Jaya,Duren Jaya,Margahayu'],
        ];
    }
}
