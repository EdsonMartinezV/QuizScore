<?php

namespace App\Http\Requests;

use App\MatchType;
use App\Models\QuizMatch;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuizMatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool{
        return $this->user()->can('create', QuizMatch::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array{
        return [
            'local_team_id' => ['required', 'exists:teams,id'],
            'guest_team_id' => ['required', 'exists:teams,id', 'different:local_team_id'],
            'type' => ['required', Rule::enum(MatchType::class)]
        ];
    }
}
