<?php

namespace krzysztofzylka\SimpleLibraries\Library;

/**
 * Cache library
 */
class Cache {

    /**
     * Cache data
     * @var array
     */
    private array $data = [];

    /**
     * Get cache data
     * @param string $name
     * @return mixed null if not exists
     */
    public function get(string $name): mixed
    {
        return $this->data[$name] ?? null;
    }

    /**
     * Set cache data
     * @param string $name
     * @param mixed $data
     * @return void
     */
    public function set(string $name, mixed $data): void
    {
        $this->data[$name] = $data;
    }

    /**
     * Get data names list
     * @return array
     */
    public function list(): array
    {
        return array_keys($this->data);
    }

    /**
     * Delete data
     * @param string $name
     * @return bool
     */
    public function delete(string $name): bool
    {
        if (isset($this->data[$name])) {
            unset($this->data[$name]);

            return true;
        }

        return false;
    }

}