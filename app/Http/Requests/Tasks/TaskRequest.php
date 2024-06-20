<?php

namespace App\Http\Requests\Tasks;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'user_id' => 'required|integer|exists:users,id',
            'deadline' => 'required|date|after_or_equal:' . Carbon::today(),
            'project_id' => 'required|integer|exists:projects,id',
        ];
    }
}
