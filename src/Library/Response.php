<?php

namespace krzysztofzylka\SimpleLibraries\Library;

class Response {

    /**
     * Response JSON data
     * @param array $data
     * @return never
     */
    public function json(array $data) : never {
        ob_end_clean();
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
        exit;
    }

}