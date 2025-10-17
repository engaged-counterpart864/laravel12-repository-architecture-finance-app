<?php

namespace App\Actions;

use App\Http\Requests\BaseRequest;

/**
 * Base action class
 *
 * @package App\Actions
 * @version 1.0.0
 */
abstract class BaseAction
{
    /**
     * The request
     *
     * @var BaseRequest
     */
    protected BaseRequest $request;

    /**
     * Set the request
     *
     * @param BaseRequest $request
     * @return static
     */
    public function request(BaseRequest $request): static
    {
        $this->request = $request;

        return $this;
    }
}