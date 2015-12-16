<?php
  function composeEmail($from, $to, $subject, $replyTo, $body)
  {

                            /* ////////////////////////////////////////////////
                                Use PHP Mailer to send an email to the customer
                                ////////////////////////////////////////////////
                            */

                            $mail = new PHPMailer;

                            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                            $mail->isSMTP();                                      // Set mailer to use SMTP
                            $mail->Host = 'mailtrap.io';                // Specify main and backup SMTP servers
                            $mail->SMTPAuth = true;                               // Enable SMTP authentication
                            $mail->Username = '532891ed9f27d8080';                   // SMTP username
                            $mail->Password = 'c89eb3a578dffe';                        // SMTP password
                            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                            $mail->Port = 465;                                    // TCP port to connect to

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
                            $mail->Body    =  $body;
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
