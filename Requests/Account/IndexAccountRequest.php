<?php

namespace App\Http\Requests\Account;

use App\Http\Requests\BaseRequest;

class IndexAccountRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->listRules();
    }
}


