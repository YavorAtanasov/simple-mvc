<?php

/*
 *      MVC framework
 * 	------------------------------------
 * 	Author:	Yavor Atanasov
 * 	Email: yavor.atanasov@gmail.com
 *      Version: 1.0.0
 */

Class contact extends BaseController {

    // Index page
    public function index($params = '') {

        // If form is submitted
        if (isset($_POST['submit'])) {

            // Load model
            $message = $this->model('contact');

            // Insert data in Contact table
            $message->insert(
                    array(
                        'message' => $_POST['message'],
                        'email' => $_POST['email'],
                        'name' => $_POST['name'],
                        'date_created' => date('Y-m-d H:i:s')
                    )
            );

            // If message succefuly stored
            if ($message)
                $data['success'] = 'Message Sent. Thank you!';

            // Else there was an error
            else
                $data['errMSG'] = 'Message was not Sent.';

            // Load mailer lib
            require_once '../lib/mail/class.phpmailer.php';

            // Initialize new mailer
            $mail = new PHPMailer();

            // Set SMTP to be used
            $mail->IsSMTP();

            // Set username and password will be required
            $mail->SMTPAuth = true;

            // Set ssl to be used
            $mail->SMTPSecure = "ssl";

            // Mail server host
            $mail->Host = MAILHOST;

            // Mail server port
            $mail->Port = MAILPORT;

            // Mail server username
            $mail->Username = MAILUSER;

            // Mail server password
            $mail->Password = MAILPASS;

            // Set Reply to 
            $mail->AddReplyTo(MAILFROM, "System");

            // Set From
            $mail->SetFrom(MAILFROM, "System");

            // Set To
            $mail->AddAddress(MAILTO);

            // Set subject
            $mail->Subject = "There is a new message from " . $_POST['name'];

            // Set body of the mail
            $mail->MsgHTML('<div><p>There is new message from ' . $_POST['name'] . '</p></div>'
                    . '<div>' . $_POST['message'] . '</div>');

            // Send mail
            $mail->Send();

            // Unset Variable
            unset($mail);
        }

        // Load view
        $this->view('contact/index', $data);
    }

}
