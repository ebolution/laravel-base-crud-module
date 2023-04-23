<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Request;

use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;
use Ebolution\Core\Infrastructure\Helpers\StringHelper;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class SaveRequest extends FormRequest
{
    use StringHelper;

    private array $rules = [];
    private array $messages = [];

    public function rules(): array
    {
        return $this->rules;
    }

    public function messages(): array
    {
        return $this->messages;
    }

    /**
     * @throws EntityException
     */
    public function failedValidation(Validator $validator): void
    {
        throw new EntityException($this->formatErrorsRequest($validator->errors()->all()), 400);
    }
}
