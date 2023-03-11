<?php

namespace krzysztofzylka\SimpleLibraries\Exception;

use Exception;

class SimpleLibraryException extends Exception {

    /**
     * Additional parameters
     * @var array
     */
    private array $parameters = [];

    /**
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param array $parameters [optional] Additional parameters
     */
    public function __construct(string $message = "", int $code = 0, array $parameters = [])
    {
        $this->parameters = $parameters;

        parent::__construct($message, $code);
    }

    /**
     * Get additional parameters
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }

}