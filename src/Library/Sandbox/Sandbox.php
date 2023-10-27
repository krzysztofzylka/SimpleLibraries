<?php

namespace krzysztofzylka\SimpleLibraries\Library\Sandbox;

use Exception;
use krzysztofzylka\SimpleLibraries\Exception\SimpleLibraryException;
use krzysztofzylka\SimpleLibraries\Library\File;
use krzysztofzylka\SimpleLibraries\Library\Sandbox\Extra\SandboxDirectory;
use krzysztofzylka\SimpleLibraries\Library\Sandbox\Extra\SandboxProcess;

/**
 * Sandbox
 * It's not 100% safe!
 */
class Sandbox {

    /**
     * File path
     * @var string
     */
    private string $phpFilePath;

    /**
     * Sandbox directory
     * @var string
     */
    private string $sandboxDirectory;

    /**
     * Sandbox file
     * @var string
     */
    private string $sandboxFile = 'code.php';

    /**
     * Sandbox file path
     * @var string
     */
    private string $sandboxFilePath;

    /**
     * Memory limit in MB
     * @var int
     */
    private int $memoryLimit = 64;

    /**
     * Time limit in seconds
     * @var int
     */
    private int $timeLimit = 10;

    /**
     * Initialize sandbox
     * @param ?string $phpFilePath
     * @param ?string $code
     * @throws SimpleLibraryException
     */
    public function __construct(?string $phpFilePath, ?string $code = null) {
        $this->sandboxDirectory = SandboxDirectory::generateSandboxDirectory();
        $this->phpFilePath = $phpFilePath;
        $this->sandboxFilePath = $this->sandboxDirectory . '/' . $this->sandboxFile;

        File::mkdir($this->sandboxDirectory);

        if (!is_null($code)) {
            file_put_contents($this->sandboxFilePath, $code);
        } else {
            File::copy($this->phpFilePath, $this->sandboxFilePath);
        }
    }

    /**
     * Set time limit
     * @param int $timeLimit
     * @return $this
     */
    public function setTimeLimit(int $timeLimit): self {
        $this->timeLimit = $timeLimit;

        return $this;
    }

    /**
     * Set memory limit
     * @param int $memoryLimit
     * @return $this
     */
    public function setMemoryLimit(int $memoryLimit): self {
        $this->memoryLimit = $memoryLimit;

        return $this;
    }

    /**
     * Run sandbox
     * @return false|string
     * @throws Exception
     */
    public function run(): bool|string {
        $sandboxProcess = new SandboxProcess();
        $sandboxProcess->sandboxDirectory = $this->sandboxDirectory;
        $sandboxProcess->sandboxFilePath = $this->sandboxFilePath;
        $sandboxProcess->timeLimit = $this->timeLimit;
        $sandboxProcess->memoryLimit = $this->memoryLimit;

        $process = $sandboxProcess->createProcess();

        $output = stream_get_contents($sandboxProcess->pipes[1]);
        fclose($sandboxProcess->pipes[1]);

        $errorOutput = stream_get_contents($sandboxProcess->pipes[2]);
        fclose($sandboxProcess->pipes[2]);

        proc_close($process);

        File::unlink($this->sandboxDirectory);

        if (!empty($errorOutput)) {
            throw new Exception($errorOutput);
        }

        return $output;
    }

}