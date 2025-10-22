<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('addUpdate', $this->route('plant'));
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:5000',
            'recorded_at' => 'required|date|before_or_equal:today',
            'photos' => 'nullable|array|max:8',
            'photos.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Update title is required.',
            'description.required' => 'Update description is required.',
            'recorded_at.required' => 'Update date is required.',
            'recorded_at.before_or_equal' => 'Update date cannot be in the future.',
            'photos.max' => 'You can upload a maximum of 8 photos.',
            'photos.*.image' => 'All files must be images.',
            'photos.*.mimes' => 'Photos must be in JPEG, PNG, JPG, or WebP format.',
            'photos.*.max' => 'Each photo must be less than 2MB.',
        ];
    }
}
