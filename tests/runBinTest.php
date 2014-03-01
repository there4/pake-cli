<?php

class RunPakeTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $composer = json_decode(file_get_contents(__DIR__ . '/../composer.json'));
        $binVersion = trim(exec(__DIR__ . '/../bin/pake version'));
        $this->assertEquals($binVersion, $composer->version);
    }
}

/* End of file runBinTest.php */
