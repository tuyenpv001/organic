<?php
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function send_email($useremail, $username, $link = ''){

    require './plugins/PHPMailer/src/Exception.php';
    require './plugins/PHPMailer/src/PHPMailer.php';
    require './plugins/PHPMailer/src/SMTP.php';

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\SMTP;
    // use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    // require 'vendor/autoload.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->CharSet = 'UTF-8';
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->SMTPDebug = 0;
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'tuyenpv2703@gmail.com';                     //SMTP username
        $mail->Password   = 'mykxpvielervntpr';                               //SMTP password
        // $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
        $mail->SMTPSecure = 'tls'; 
        // $mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('tuyenpv2703@gmail.com', 'Organic Store');
        $mail->addAddress($useremail, $username);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Xác thực tài khoản';
        $mail->Body    = '<p>Xin chào '.$username.'! Vui lòng click vào đường link bên dưới để xác thực tài khoản của bạn. Xin cảm ơn!!!.</p>
        <a href="'.$link.'">'.$link.'</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        // echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }

    return false;

}




// send_email('6051071139@st.utc2.edu.vn','Tuyen PV');

