<?php
  function composeEmail($from, $to, $subject, $replyTo, $fullEmailContent)
  {

                            /* ////////////////////////////////////////////////
                                Use PHP Mailer to send an email to the customer
                                ////////////////////////////////////////////////
                            */

                            $mail = new PHPMailer;

                            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = '	smtp-mail.outlook.com';                // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'kenicenoel@outlook.com';                   // SMTP username
                            $mail->Password = 'k3ninjan03l';                        // SMTP password
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 587;                                // TCP port to connect to

                            $mail->setFrom($from);
                            // $mail->addAddress('guischard@shipwebsource.com', 'Charles');     // Add a recipient
                            $mail->addAddress($to);                                          // Name is optional
                            $mail->addReplyTo($replyTo);



                            // $mail->addCC('cc@example.com');
                            // $mail->addBCC('bcc@example.com');

                            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
                            $mail->isHTML(true);                                  // Set email format to HTML

                            $mail->Subject = $subject;
                            $mail->Body    =  $fullEmailContent;
                            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                            if(!$mail->send())
                            {
                                $errors.='Sorry. Message could not be sent.';
                                $errors.='<br>Mailer Error: ' . $mail->ErrorInfo;
                            }
                            else
                            {
                                $errors.='Message has been sent: ';
                            }

                            return $errors;
  }





 ?>
