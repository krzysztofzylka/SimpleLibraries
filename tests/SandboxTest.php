<?php

use PHPUnit\Framework\TestCase;
use krzysztofzylka\SimpleLibraries\Library\Sandbox\Sandbox;

class SandboxTest extends TestCase {

    public function testRunSandboxWithCode() {
        $code = '<?php echo "Hello, World!";';
        $sandbox = new Sandbox(null, $code);
        $result = $sandbox->run();
        $this->assertEquals("Hello, World!", $result);
    }

}
