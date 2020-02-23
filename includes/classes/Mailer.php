<?php

/*
 * Mailer
 * Abstract Class
 * */

abstract class Mailer
{
    // Properties
    protected $subject;
    protected $message;
    protected $to;
    protected $from;
    protected $to_group;
    protected $template;

    /**
     * Mailer constructor.
     * @param $subject
     * @param $message
     * @param $from
     * @param $to
     * @param bool $to_group
     * @param string $template
     */
    public function __construct($subject, $message, $from, $to, $to_group = false, $template = "default.html")
    {
        $this->subject = filter_var(trim($subject), FILTER_SANITIZE_STRING);;
        $this->message = trim($message);
        $this->from = filter_var(trim($from), FILTER_SANITIZE_STRING);;
        $this->to = $to;
        $this->to_group = (bool)$to_group;
        $this->template = filter_var(trim($template), FILTER_SANITIZE_STRING);
    }

    /**
     * Mail Header
     * @return string
     */
    final protected function header()
    {
        $header = "From: " . $this->from . " <amp_" . rand(111, 999) . ">\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type:text/html;charset=UTF-8\r\n";

        return $header;
    }

    /**
     * Prepare the template
     * @param $email
     * @param $template
     * @return mixed
     */
    final protected function prepTemplate($email, $template)
    {
        $recipientName = preg_replace("/" . stristr($email, '@') . "/", '', $email);
        $template = str_replace('$recipientName', $recipientName, $template);
        $template = str_replace('$recipientEmail', $email, $template);
        $template = str_replace('$message', $this->message, $template);

        return $template;
    }

    /**
     * Send the e-mail
     * @param $email
     * @param $template
     */
    final protected function messenger($email, $template)
    {
        $email = $this->sanitizer($email);
        $template = $this->prepTemplate($email, $template);
        do {
            $send = mail($email, $this->subject, $template, $this->header());
        } while (!$send);
    }

    /**
     * Sanitize email
     * @param $email
     * @return mixed
     */
    final protected function sanitizer($email)
    {
        return filter_var(strtolower(trim($email)), FILTER_SANITIZE_EMAIL);
    }

    /**
     * Validate email
     * @param $email
     * @return mixed
     */
    final protected function validator($email)
    {
        return filter_var(strtolower(trim($email)), FILTER_VALIDATE_EMAIL);
    }

    /**
     *  Send the Mail
     */
    abstract public function send();

    /**
     * Validate the email to send mail to
     * @return $this
     */
    abstract public function validate();
}
