<?php

/*
 ****************************************************************************
             _______                      __
            /       \                    /  |
            $$$$$$$  | ______    ______  $$ |  ______   __   __   __
            $$ |__$$ |/      \  /      \ $$ | /      \ /  | /  | /  |
            $$    $$/ $$$$$$  |/$$$$$$  |$$ |/$$$$$$  |$$ | $$ | $$ |
            $$$$$$$/  /    $$ |$$ |  $$ |$$ |$$ |  $$ |$$ | $$ | $$ |
            $$ |     /$$$$$$$ |$$ |__$$ |$$ |$$ \__$$ |$$ \_$$ \_$$ |
            $$ |     $$    $$ |$$    $$/ $$ |$$    $$/ $$   $$   $$/
            $$/       $$$$$$$/ $$$$$$$/  $$/  $$$$$$/   $$$$$/$$$$/
                               $$ |
                               $$ |
                               $$/
 ****************************************************************************
 */

class SendMail
{
    // Properties
    private $subject;
    private $message;
    private $to;
    private $from;
    private $to_group;
    private $template;

    /**
     * SendMail constructor.
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
     * @return string
     */
    public function __toString()
    {
        return "SendMail Class";
    }

    /**
     * Mail Header
     * @return string
     */
    private function header()
    {
        $header = "From: " . $this->from . " <amp_" . rand(111, 999) . ">\r\n";
        $header .= "MIME-Version: 1.0\r\n";
        $header .= "Content-type:text/html;charset=UTF-8\r\n";

        return $header;
    }

    /**
     * Prepare the template
     * @param $placeholder
     * @param $template
     * @return mixed
     */
    private function prepTemplate($placeholder, $template)
    {
        $template = str_replace('$recipientName', preg_replace("/" . stristr($placeholder, '@') . "/", '', $placeholder), $template);
        $template = str_replace('$recipientEmail', $placeholder, $template);
        $template = str_replace('$message', $this->message, $template);

        return $template;
    }

    /**
     * Validate the email to send mail to
     * @return $this
     */
    public function validateInput()
    {
        try {
            if ($this->to_group && !empty($this->to) && is_file($this->to)) {
                $emailList = file_get_contents($this->to);
                $emails = explode("\n", $emailList);
                if (end($emails) === "") array_pop($emails);
                foreach ($emails as $email) {
                    if (!filter_var(strtolower(trim($email)), FILTER_VALIDATE_EMAIL))
                        throw new Exception('Invalid email format ( ' . $email . ' ).');
                }
            } else {
                if (!filter_var(strtolower(trim($this->to)), FILTER_VALIDATE_EMAIL))
                    throw new Exception('Invalid email format ( ' . $this->to . ' ).');
            }
        } catch (Exception $exception) {
            $_SESSION['msg'] = ['Oops! ' . $exception->getMessage(), false];
            header('Location: ./index.php');
            die();
        }

        return $this;
    }

    /**
     *  Send the Mail
     */
    public function send()
    {
        try {
            $template = file_get_contents("./templates/" . $this->template);

            if ($this->to_group && !empty($this->to) && is_file($this->to)) {
                $emailList = file_get_contents($this->to);
                $emails = explode("\n", $emailList);
                if (end($emails) === "") array_pop($emails);
                foreach ($emails as $email) {
                    $template = $this->prepTemplate($email, $template);
                    do {
                        $send = mail(filter_var(strtolower(trim($email)), FILTER_SANITIZE_EMAIL), $this->subject, $template, $this->header());
                    } while (!$send);
                }
            } else {
                $template = $this->prepTemplate($this->to, $template);
                do {
                    $send = mail(filter_var(strtolower(trim($this->to)), FILTER_SANITIZE_EMAIL), $this->subject, $template, $this->header());
                } while (!$send);
            }

            $_SESSION['msg'] = ['Message sent successfully.', true];
        } catch (\Exception $exception) {
            $_SESSION['msg'] = ['Oops! ' . $exception->getMessage(), false];
        }
    }

}
