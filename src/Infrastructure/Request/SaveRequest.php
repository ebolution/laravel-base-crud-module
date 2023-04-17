<?php

namespace Ebolution\BaseCrudModule\Infrastructure\Request;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Ebolution\Core\Infrastructure\Helpers\StringHelper;
use Ebolution\BaseCrudModule\Domain\Exceptions\EntityException;

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
