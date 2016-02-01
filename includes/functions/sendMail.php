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
                            $mail->Host = 'smtpout.secureserver.net';
                            // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = 'wh@shipwebsource.com';                   // SMTP username
                            $mail->Password = 'warehouse';                        // SMTP password
                            $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 465;                                // TCP port to connect to

                            $mail->setFrom($from);
                            $mail->addAddress('kenice@shipwebsource.com', 'Kenice N');     // Add a recipient
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
