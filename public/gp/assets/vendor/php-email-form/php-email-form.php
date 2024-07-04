<?php
class PHP_Email_Form {
  public $to;
  public $from_name;
  public $from_email;
  public $subject;
  public $messages = array();
  public $smtp = array();
  public $ajax = false;

  public function add_message($content, $label, $priority = 0) {
    $this->messages[] = array(
      'content' => $content,
      'label' => $label,
      'priority' => $priority
    );
  }

  public function send() {
    $headers = 'From: ' . $this->from_name . ' <' . $this->from_email . '>' . "\r\n";
    $headers .= 'Reply-To: ' . $this->from_email . "\r\n";
    $headers .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-Type: text/html; charset=UTF-8' . "\r\n";

    $message_content = '<html><body>';
    foreach ($this->messages as $message) {
      $message_content .= '<p><strong>' . $message['label'] . ':</strong> ' . nl2br($message['content']) . '</p>';
    }
    $message_content .= '</body></html>';

    if (!empty($this->smtp)) {
      return $this->send_smtp($this->to, $this->subject, $message_content, $headers);
    } else {
      return mail($this->to, $this->subject, $message_content, $headers);
    }
  }

  private function send_smtp($to, $subject, $message, $headers) {
    $smtp_host = $this->smtp['host'];
    $smtp_username = $this->smtp['username'];
    $smtp_password = $this->smtp['password'];
    $smtp_port = $this->smtp['port'];

    // Create the SMTP connection
    $connection = fsockopen($smtp_host, $smtp_port);
    if (!$connection) {
      return false;
    }

    // Authenticate with the SMTP server
    $this->smtp_command($connection, 'EHLO ' . $smtp_host);
    $this->smtp_command($connection, 'AUTH LOGIN');
    $this->smtp_command($connection, base64_encode($smtp_username));
    $this->smtp_command($connection, base64_encode($smtp_password));

    // Send the email
    $this->smtp_command($connection, 'MAIL FROM:<' . $this->from_email . '>');
    $this->smtp_command($connection, 'RCPT TO:<' . $to . '>');
    $this->smtp_command($connection, 'DATA');
    $this->smtp_command($connection, $headers . "\r\n" . $message . "\r\n.");
    $this->smtp_command($connection, 'QUIT');

    fclose($connection);
    return true;
  }

  private function smtp_command($connection, $command) {
    fputs($connection, $command . "\r\n");
    $response = fgets($connection, 512);
    return $response;
  }
}
?>
