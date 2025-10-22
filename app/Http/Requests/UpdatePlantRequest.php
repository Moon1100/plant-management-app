<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlantRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('plant'));
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'batch' => 'nullable|string|max:255',
            'notes' => 'nullable|string|max:5000',
            'planted_at' => 'nullable|date|before_or_equal:today',
            'insertion_date' => 'nullable|date|before_or_equal:today',
            'farm_id' => 'required|exists:farms,id',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'remove_images' => 'nullable|array',
            'remove_images.*' => 'string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Plant name is required.',
            'planted_at.before_or_equal' => 'Planted date cannot be in the future.',
            'insertion_date.before_or_equal' => 'Insertion date cannot be in the future.',
            'farm_id.required' => 'Please select a farm.',
            'farm_id.exists' => 'Selected farm does not exist.',
            'images.max' => 'You can upload a maximum of 10 images.',
            'images.*.image' => 'All files must be images.',
            'images.*.mimes' => 'Images must be in JPEG, PNG, JPG, or WebP format.',
            'images.*.max' => 'Each image must be less than 2MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        // Ensure farm belongs to authenticated user
        if ($this->farm_id) {
            $farm = auth()->user()->farms()->find($this->farm_id);
            if (!$farm) {
                $this->merge(['farm_id' => null]);
            }
        }
    }
}
