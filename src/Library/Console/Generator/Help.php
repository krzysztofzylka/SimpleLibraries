<?php

namespace krzysztofzylka\SimpleLibraries\Library\Console\Generator;

use krzysztofzylka\SimpleLibraries\Library\Console\Prints;

/**
 * Help generator
 */
class Help {

    private array $helpers = [];

    /**
     * Add help
     * @param string $command
     * @param string $message
     * @return void
     */
    public function addHelp(string $command, string $message) : void {
        $this->helpers[] = [$command, $message];
    }

    /**
     * Render helper
     * @return void
     */
    public function render() : void {
        foreach ($this->helpers as $data) {
            $text = $data[0] . str_repeat(' ', $this->getSpaces($data[0])) . ' - '  .$data[1];

            Prints::print($text);
        }
    }

    /**
     * Get space for line
     * @param string|null $text
     * @return int
     */
    private function getSpaces(?string $text = null) : int {
        $spaces = max(array_map('strlen', array_column($this->helpers, 0)));

        if (!$text) {
            return $spaces;
        }

        $spaces -= strlen($text);

        return $spaces;
    }

}