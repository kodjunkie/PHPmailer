<?php

use \PHPUnit\Framework\TestCase;

class SendMailTest extends TestCase
{
    /**
     * This method is called before each test.
     */
    public function setUp(): void
    {
        $this->sendmail = Mockery::mock(SendMail::class);
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
        $this->sendmail->shouldReceive('validateInput')->once()->andReturn(true);
        $this->assertTrue($this->sendmail->validateInput());
    }

    public function testSend()
    {
        $this->sendmail->expects()->send()->once()->andReturn(true);
        $this->assertTrue($this->sendmail->send());
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
