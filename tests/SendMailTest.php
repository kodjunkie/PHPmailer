<?php

use \PHPUnit\Framework\TestCase;

class SendMailTest extends TestCase
{
    public static $sendmail;

    /**
     * This method is called before each test.
     */
    public function setUp(): void
    {
        self::$sendmail = Mockery::mock(SendMail::class);
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testValidateInput()
    {
        self::$sendmail->shouldReceive('validateInput')->once()->andReturn(true);
        $this->assertTrue(self::$sendmail->validateInput());
    }

    public function testSend()
    {
        self::$sendmail->expects()->send()->once()->andReturn(true);
        $this->assertTrue(self::$sendmail->send());
    }

    public function test__toString()
    {
        $this->expectOutputString("SendMail Class");
        print new SendMail(
            'Tests',
            'Testing',
            'admin@test.com',
            'tester@test.com',
            false);
    }
}
