<?php

namespace krzysztofzylka\SimpleLibraries\Library\Console\Generator;

use krzysztofzylka\SimpleLibraries\Library\Console\Prints;

/**
 * Table generator
 */
class Table {

    private array $data = [];

    private array $columns = [];

//    private array $style = ['|', '-', '|'];
    private array $style = ["┌", '─', '┐', '│', '┬', '└', '┘', '┴'];

    private array $renderData = [];

    /**
     * Add column
     * @param string $name
     * @param string $data
     * @return void
     */
    public function addColumn(string $name, string $data) : void {
        $this->columns[] = [
            'name' => $name,
            'data' => $data,
            'space' => strlen($name)
        ];

        $this->calculateSpace();
    }

    /**
     * Set table data
     * @param array $data
     * @return void
     */
    public function setData(array $data) : void {
        $this->data = $data;

        $this->calculateSpace();
    }

    /**
     * Render table
     * @return void
     */
    public function render() : void {
        if (empty($this->columns) || empty($this->data)) {
            print('Empty table');

            return;
        }

        $this->renderHeader();
        $this->renderData();
        $this->renderData[] = $this->renderData[0];

        foreach ($this->renderData as $id => $renderData) {
            $left = $id === 0 ? 0 : (count($this->renderData) - 1 === $id ? 5 : 3);
            $center = $id === 0 ? 4 : (count($this->renderData) - 1 === $id ? 7 : 3);
            $bottom = $id === 0 ? 2 : (count($this->renderData) - 1 === $id ? 6 : 3);

            print($this->style[$left]);
            print(implode($this->style[$center], $this->renderData[$id]));
            print($this->style[$bottom]);
            print(PHP_EOL);
        }
    }

    /**
     * Render header
     * @return void
     */
    private function renderHeader() : void {
        $data = [];
        $data2 = [];
        $data3 = [];

        foreach ($this->columns as $column) {
            $data[] = str_repeat($this->style[1], $column['space'] + 2);
            $data2[] = ' ' . $column['name'] . str_repeat(' ', $column['space'] - strlen($column['name']) + 1);
            $data3[] = str_repeat($this->style[1], $column['space'] + 2);
        }

        $this->renderData[] = $data;
        $this->renderData[] = $data2;
        $this->renderData[] = $data3;
    }

    /**
     * Render data
     * @return void
     */
    private function renderData() : void {
        foreach ($this->data as $data) {
            $addData = [];

            foreach ($this->columns as $column) {
                $value = $data[$column['data']] ?? '';
                $addData[] = ' ' . $value . (strlen($value) < $column['space'] ? str_repeat(' ', $column['space'] - strlen($value)) : '') . ' ';
            }

            $this->renderData[] = $addData;
        }
    }

    /**
     * Calculate space
     * @return void
     */
    private function calculateSpace() : void {
        foreach ($this->columns as $key => $column) {
            $this->columns[$key]['space'] = strlen($column['name']);

            if (isset($this->data[0][$column['data']])) {
                $spaces = max(array_map('strlen', array_column($this->data, $column['data'])));

                if ($spaces > $this->columns[$key]['space']) {
                    $this->columns[$key]['space'] = $spaces;
                }
            }
        }
    }

}