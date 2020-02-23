<?php

use \PHPUnit\Framework\TestCase;

class SendMailTest extends TestCase
{
    protected $sendmail;

    /**
     * This method is called before each test.
     */
    public function setUp(): void
    {
        $this->sendmail = Mockery::mock('SendMail[validate,send]', [
            'Tests', 'Testing', 'admin@test.com', 'tester@test.com'
        ]);
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        Mockery::close();
    }

    public function testValidate()
    {
        $this->sendmail->shouldReceive('validate')->with()->once()->andReturn(true);
        $expected = $this->sendmail->validate();
        $this->assertTrue($expected);
    }

    public function testSend()
    {
        $this->sendmail->expects()->send()->once()->andReturn(true);
        $expected = $this->sendmail->send();
        $this->assertTrue($expected);
    }
}
