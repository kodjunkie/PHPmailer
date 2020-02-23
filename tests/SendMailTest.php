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
        $this->sendmail = new SendMail('Tests', 'Testing', 'admin@test.com', 'tester@test.com');
    }

    public function testCanConstruct()
    {
        $this->assertInstanceOf(SendMail::class, $this->sendmail);
    }

    public function testValidate()
    {
        $expected = $this->sendmail->validate();
        $this->assertInstanceOf(SendMail::class, $expected);
    }

    public function testReturnExceptionOnInvalidEmail()
    {
        $sendmail = new SendMail('Tests', 'Testing', 'admin@test.com', 'tester@test');
        $this->expectException(InvalidArgumentException::class);
        $sendmail->validate();
    }

    public function testSend()
    {
        $sendmail = Mockery::mock('SendMail[send]', [
            'Tests', 'Testing', 'admin@test.com', 'tester@test.com'
        ]);
        $sendmail->expects()->send()->once()->andReturn(true);
        $this->assertTrue($sendmail->send());
    }

    /**
     * This method is called after each test.
     */
    public function tearDown(): void
    {
        Mockery::close();
    }
}
