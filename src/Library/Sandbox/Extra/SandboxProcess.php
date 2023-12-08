<?php

namespace krzysztofzylka\SimpleLibraries\Library\Sandbox\Extra;

use Exception;

class SandboxProcess {

    /**
     * Sadnbox file path
     * @var string
     */
    public string $sandboxFilePath;

    /**
     * Sandbox directory
     * @var string
     */
    public string $sandboxDirectory;

    /**
     * Memory limit in MB
     * @var int
     */
    public int $memoryLimit = 64;

    /**
     * Time limit in seconds
     * @var int
     */
    public int $timeLimit = 10;

    /**
     * Process pipes
     * @var mixed
     */
    public mixed $pipes;

    /**
     * Initialize sandbox process
     * @return resource
     * @throws Exception
     */
    public function createProcess() {
        $process = proc_open(
            'php ' . escapeshellarg($this->sandboxFilePath),
            [
                0 => ['pipe', 'r'],
                1 => ['pipe', 'w'],
                2 => ['pipe', 'w'],
            ],
            $this->pipes,
            $this->sandboxDirectory,
            [
                'memory_limit' => $this->memoryLimit . 'M',
                'max_execution_time' => $this->timeLimit,
            ]
        );

        if (!is_resource($process)) {
            throw new Exception('Process not created');
        }

        return $process;
    }

}