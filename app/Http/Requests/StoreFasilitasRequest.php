<?php
// app/Http/Requests/StoreFasilitasRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFasilitasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // pastikan true kalau tidak pakai policy
    }

    public function rules(): array
    {
        return [
            'jenis_fasilitas_id' => 'required|exists:jenis_fasilitas,id',
            'nama' => 'required|string|max:255',
            'unit' => 'nullable|string|max:50',
            'luas' => 'nullable|numeric',
            'lama_sewa' => 'nullable|string|max:50',

            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'gambar_fasilitas.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'detail_fasilitas.*.nama' => 'required|string|max:255',
            'detail_fasilitas.*.unit' => 'nullable|string|max:50',
            'detail_fasilitas.*.luas' => 'nullable|numeric',
            'detail_fasilitas.*.lama_sewa' => 'nullable|string|max:50',

            'tarif_detail.*.*' => 'nullable|numeric|min:0',
            'tarif_utama.*' => 'nullable|numeric|min:0', // max 2MB per gambar
        ];
    }

    public function messages(): array
    {
        return [
            'detail_fasilitas.*.nama.required_with' => 'Nama pada detail fasilitas wajib diisi.',
            'gambar_fasilitas.*.image' => 'File harus berupa gambar (jpg, png, dll).',
            'gambar_fasilitas.*.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }
}
