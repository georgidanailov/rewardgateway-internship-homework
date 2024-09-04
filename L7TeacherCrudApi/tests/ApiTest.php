<?php

use PHPUnit\Framework\TestCase;

require_once 'api.php';

class ApiTest extends TestCase
{
    private $jsonFile = 'tests/teachers_test.json';

    protected function setUp(): void
    {
        file_put_contents($this->jsonFile, json_encode([]));
    }

    protected function tearDown(): void
    {
        if (file_exists($this->jsonFile)) {
            unlink($this->jsonFile);
        }
    }

    public function testReadJsonFile()
    {
        $expected = [];

        $result = readJsonFile($this->jsonFile);

        $this->assertEquals($expected, $result);
    }

    public function testWriteJsonFile()
    {
        $data = [
            '1' => ['name' => 'John Doe', 'subject' => 'Math'],
            '2' => ['name' => 'Jane Doe', 'subject' => 'Science']
        ];

        writeJsonFile($data, $this->jsonFile);

        $result = readJsonFile($this->jsonFile);

        $this->assertEquals($data, $result);
    }
}
