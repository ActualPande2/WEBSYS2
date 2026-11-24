<?php

namespace App\Http\Requests;

use App\Models\Thread;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReplyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        $thread = $this->route('thread');
        $threadId = $thread instanceof Thread ? $thread->getKey() : (int) $thread;

        return [
            'content' => ['required', 'string'],
            'parent_id' => [
                'sometimes',
                'nullable',
                'integer',
                Rule::exists('replies', 'id')->where('thread_id', $threadId),
            ],
        ];
    }
}
