<?php

namespace krzysztofzylka\SimpleLibraries\Library\Console\Generator;

use krzysztofzylka\SimpleLibraries\Library\Console\Helper\Color;
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
        $this->helpers[] = [$command, $message, 'type' => 'help'];
    }

    /**
     * Add console header
     * @param string $header
     * @return void
     */
    public function addHeader(string $title, int|string $color = null) : void {
        $this->helpers[] = ['', $title, 'type' => 'header', 'color' => $color];
    }

    /**
     * Render helper
     * @return void
     */
    public function render() : void {
        foreach ($this->helpers as $data) {
            switch ($data['type']) {
                case 'header':
                    $text = Color::generateColor(isset($data['color']) ? $data['color'] : 'blue') . $data[1] . Color::generateColor();
                    break;
                default:
                    $text = $data[0] . str_repeat(' ', $this->getSpaces($data[0])) . ' - '  .$data[1];
                    break;
            }

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