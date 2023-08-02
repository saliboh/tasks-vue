<?php

namespace App\Http\Requests;

use App\Enums\TaggedChallengeLevelEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => [
                'required',
                'integer',
                'exists:tasks,id',
            ],
            'title' => [
                'required',
                'string',
            ],
            'description' => [
                'required',
                'string',
            ],
            'due_date' => [
                'required',
                'date',
            ],
            'status' => [
                'nullable',
                Rule::in(TaskStatusEnum::getValues()),
            ],
        ];
    }
}
