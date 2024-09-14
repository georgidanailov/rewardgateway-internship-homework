<?php


require_once 'src/Database.php';

$database = new Database();
$conn = $database->getConnection();

use PHPUnit\Framework\TestCase;

class TeamsApiTest extends TestCase
{
    private $mockDatabase;
    private $mockConnection;
    private $mockStatement;

    protected function setUp(): void
    {
        $this->mockDatabase = $this->createMock(Database::class);

        $this->mockConnection = $this->createMock(mysqli::class);

        $this->mockStatement = $this->createMock(mysqli_stmt::class);

        $this->mockDatabase->method('getConnection')->willReturn($this->mockConnection);
    }

    public function testGetTeamsReturnsTeamsList()
    {
        $mockResult = $this->createMock(mysqli_result::class);
        $mockResult->method('fetch_assoc')->willReturnOnConsecutiveCalls(
            ['id' => 1, 'name' => 'Team A', 'city' => 'New York'],
            null // Simulates the end of the result set
        );

        $this->mockConnection->method('query')->willReturn($mockResult);

        ob_start();
        $_GET['url'] = 'teamsapi';
        $_SERVER['REQUEST_METHOD'] = 'GET';

        include 'src/teamsapi.php';

        $output = ob_get_clean();

        $this->assertJson($output);
        $this->assertStringContainsString('"name":"Team A"', $output);
    }

    public function testPostCreatesNewTeam()
    {
        $this->mockConnection->method('prepare')->willReturn($this->mockStatement);
        $this->mockStatement->method('execute')->willReturn(true);
        $this->mockStatement->affected_rows = 1;

        $_GET['url'] = 'teamsapi';
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['name'] = 'Team B';
        $_POST['city'] = 'Los Angeles';

        ob_start();
        include 'src/teamsapi.php';
        $output = ob_get_clean();

        $this->assertJson($output);
        $this->assertStringContainsString('"success":true', $output);
        $this->assertStringContainsString('Team added successfully', $output);
    }

    public function testPutUpdatesTeam()
    {
        $this->mockConnection->method('prepare')->willReturn($this->mockStatement);
        $this->mockStatement->method('execute')->willReturn(true);
        $this->mockStatement->affected_rows = 1;

        $_GET['url'] = 'teamsapi/1';
        $_SERVER['REQUEST_METHOD'] = 'PUT';
        parse_str("name=Team C&city=San Francisco", $_PUT);

        ob_start();
        include 'src/teamsapi.php';
        $output = ob_get_clean();

        $this->assertJson($output);
        $this->assertStringContainsString('"success":true', $output);
        $this->assertStringContainsString('Team updated successfully', $output);
    }

    public function testDeleteRemovesTeam()
    {
        $this->mockConnection->method('prepare')->willReturn($this->mockStatement);
        $this->mockStatement->method('execute')->willReturn(true);
        $this->mockStatement->affected_rows = 1;

        $_GET['url'] = 'teamsapi/1';
        $_SERVER['REQUEST_METHOD'] = 'DELETE';

        ob_start();
        include 'src/teamsapi.php';
        $output = ob_get_clean();

        $this->assertJson($output);
        $this->assertStringContainsString('"success":true', $output);
        $this->assertStringContainsString('Team deleted successfully', $output);
    }
}
