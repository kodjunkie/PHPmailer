<?php

require_once(__DIR__ . "/SendMail.php");

/*
 * Send mail class
 * */

class SendMail extends Mailer
{
    /**
     * Validate the email to send mail to
     * @return $this
     * @throws Exception
     */
    public function validate()
    {
        if ($this->to_group && !empty($this->to) && is_file($this->to)) {
            $emailList = file_get_contents($this->to);
            $emails = explode("\n", $emailList);
            if (end($emails) === "") array_pop($emails);
            foreach ($emails as $email) {
                if (!$this->validator($email))
                    throw new InvalidArgumentException('Invalid email format "' . $email . '"');
            }
        } else {
            if (!$this->validator($this->to))
                throw new InvalidArgumentException('Invalid email format "' . $this->to . '"');
        }

        return $this;
    }

    /**
     *  Send the Mail
     */
    public function send()
    {
        $template = file_get_contents("./templates/" . $this->template);

        if ($this->to_group && !empty($this->to) && is_file($this->to)) {
            $emailList = file_get_contents($this->to);
            $emails = explode("\n", $emailList);
            if (end($emails) === "") array_pop($emails);
            foreach ($emails as $email) {
                $this->messenger($email, $template);
            }
        } else {
            $this->messenger($this->to, $template);
        }

        $_SESSION['msg'] = ['Message sent successfully.', true];
    }

}
