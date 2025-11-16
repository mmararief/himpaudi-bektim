<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DataPribadiUpdateRequest extends FormRequest
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
        $dataPribadi = optional($this->user()->dataPribadi);
        $ignoreId = $dataPribadi->id ?? null;

        return [
            'niptk_nuptk' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('data_pribadi', 'niptk_nuptk')->ignore($ignoreId),
            ],
            'no_kta_lama' => ['nullable', 'string', 'max:50'],
            'no_ktp' => [
                'required',
                'string',
                'max:16',
                Rule::unique('data_pribadi', 'no_ktp')->ignore($ignoreId),
            ],
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'pendidikan_terakhir' => ['required', 'string', 'max:50'],
            'tmt_kerja' => ['required', 'date'],
            'riwayat_diklat' => ['nullable', 'array'],
            'alamat_domisili' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:15'],
            'foto_profil' => ['nullable', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ];
    }
}
