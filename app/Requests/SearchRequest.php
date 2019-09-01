<?php

namespace App\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SearchRequest
 *
 * @package Components\Users\Requests
 */
class SearchRequest extends FormRequest
{
    /**
     * @return array
     */
    public function getSearchFields(): array
    {
        $fields = $this->only(array_keys($this->rules()));
        return $fields;
    }

    /**
     * Get the validation rules for UpdateProfile.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'fullName' => ['sometimes', 'string', 'min:3'],

            'createAt'      => ['sometimes', 'array'],
            'createAt.from' => ['required_with:createAt', 'string', 'date'],
            'createAt.to'   => ['required_with:createAt', 'string', 'date'],

            'customValue' => ['sometimes', 'string']
        ];
    }
}
