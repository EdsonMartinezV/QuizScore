<?php

namespace App\Http\Requests;

use App\Models\QuizMatch;
use Illuminate\Foundation\Http\FormRequest;

class ScoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool{
        return $this->user()->can('update', QuizMatch::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array{
        return [
            'id' => ['required', 'exists:quiz_matches'],
            'local_score' => ['required', 'numeric', 'integer', 'max:480'],
            'guest_score' => ['required', 'numeric', 'integer', 'max:480']
        ];
    }
}
