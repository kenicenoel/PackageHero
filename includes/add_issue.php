<?php
  include_once "config.php";
  require 'classes/php-mailer/PHPMailerAutoload.php';
  require_once ('functions/sendMail.php');

          if(isset($_FILES['images']) && isset($_POST['trackingnumber']))
          {
            $trackingnumber = $_POST['trackingnumber'];
            $customername = $_POST['customername'];
            $mainissue = $_POST['mainissue'];
            $description = $_POST['description'];
            $itemtype = $_POST['itemtype'];
            $shippingcarrier = $_POST['shippingcarrier'];

            $sql = "INSERT INTO packages(TrackingNumber, CustomerName, MainIssue, Description, ItemType, ShippingCarrier ) VALUES(:TrackingNumber,:CustomerName,:MainIssue,:Description,:ItemType,:ShippingCarrier)";

                //prepare the sql statement
                $stmt = $connection->prepare($sql);

                // bind variables to the paramenters ? present in sql
                $stmt->bindParam('TrackingNumber', $trackingnumber, PDO::PARAM_STR);
                $stmt->bindParam('CustomerName', $customername, PDO::PARAM_STR);
                $stmt->bindParam('MainIssue', $mainissue, PDO::PARAM_STR);
                $stmt->bindParam('Description', $description, PDO::PARAM_STR);
                $stmt->bindParam('ItemType', $itemtype, PDO::PARAM_STR);
                $stmt->bindParam('ShippingCarrier', $shippingcarrier, PDO::PARAM_STR);


              //execute the prepared statement
              $stmt->execute();

            $images = $_FILES['images'];
            $i=1;
            $last = $connection->lastInsertId();
            $errors="";

            foreach($images['name'] as $position => $data)
            {
              $target_dir = "uploads/";
              // $target_file = $target_dir . basename($_FILES["images"]["name"][$position]);
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
              $extension = pathinfo($name, PATHINFO_EXTENSION);

              $target_file = $target_dir.time()."_".basename($_FILES["images"]["name"][$position]);
              $uploadOk = 1;


              // Check if image file is a actual image or fake image
                // $check = getimagesize($images["tmp_name"][$position]);
                //
                //   if($check != false)
                //   {
                //       $uploadOk = 1;
                //   }
                //   else
                //   {
                //       echo "File is not an image.";
                //       $uploadOk = 0;
                //   }

                  // Check if file already exists and if so, append a number to it
                  // if (file_exists($target_file))
                  // {
                  //
                  //         // $name = $_FILES['images']['name'][$position];
                  //         // $actual_name = pathinfo($name,PATHINFO_FILENAME);
                  //         // $extension = pathinfo($name, PATHINFO_EXTENSION);
                  //         //
                  //         // $i = 1;
                  //         // while(file_exists('uploads/'.$actual_name.".".$extension))
                  //         // {
                  //         //   $actual_name = (string)$actual_name.$i;
                  //         //   $target_file_new = $actual_name.".".$extension;
                  //         //   $i++;
                  //         // }
                  //
                  //
                  //   // $i = 1;
                  //   // while(file_exists($target_file))
                  //   // {
                  //   //   $new_name = (string)$target_file.$i;
                  //   //   $target_file = $new_name;
                  //   //   $i++;
                  //   // }
                  //      echo "Image ".$target_file." already exists. Try renaming the image first.";
                  //
                  //     $uploadOk = 0;
                  //
                  // }

                // Check file size to ensure it is not larger than 6MB
                if ($images["size"][$position] > 6000000)
                {
                    $errors.="One or more images are larger than 50MB. Try again.";
                    $uploadOk = 0;

                }
                // // Allow certain file formats
                // if($imageFileType != "jpg" && $imageFileType != "jpeg")
                // {
                //     echo "Sorry, only JPG, JPEG files are allowed.";
                //     $uploadOk = 0;
                // }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0)
                {
                  $sql = "DELETE from packages WHERE PackageID = :PackageID";

                    //prepare the sql statement
                    $stmt = $connection->prepare($sql);

                    // bind variables to the paramenters ? present in sql
                    $stmt->bindParam(':PackageID', $last, PDO::PARAM_INT);

                    //execute the prepared statement
                    $stmt->execute();
                    echo "Error";

                    goto end;

                // if everything is ok, try to upload file
                }
                else
                {
                    if (move_uploaded_file($images["tmp_name"][$position], $target_file))
                    {
                      $sql = "UPDATE packages SET Photo{$i}= :Photo WHERE PackageID = :PackageID";

                        //prepare the sql statement
                        $stmt = $connection->prepare($sql);

                        // bind variables to the paramenters ? present in sql
                        $stmt->bindParam(':Photo', ${'image'.$i}, PDO::PARAM_STR);
                        $stmt->bindParam(':PackageID', $last, PDO::PARAM_INT);
                        ${'image'.$i} = $target_file;

                        //execute the prepared statement
                        $stmt->execute();
                        $i++;

                        // Setup the email header
                        $header =
                        '
                        <!DOCTYPE html>
                        <html>
                        <head>
                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                            <title></title>
                        </head>

                      <body style="-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; height: 100%; line-height: 1.6; width: 100% !important">

                      <table class="body-wrap" style="border: 1px solid #d2d9d2; margin: 0 auto">

                          <div class="content">

                                    <tr style="width: 80%">
                                      <td class="content-block">
                                        <img src="http://packagehero.websource-caribbean.com/ImageProxy.png" alt="Web Source Logo" style="height: 73px; margin: 0 120px; vertical-align: middle; width: 223px">
                                      </td>
                                    </tr>
                                    <tr style="width: 80%">
                                      <td class="content-block">
                                        <h1 style="background-color: #FF0000; color: #fff; font-size: 25px; font-weight: 500; line-height: 1.2; margin: 10px 0; padding: 5px 0; text-align: center" align="center">We require your assistance</h1>
                                      </td>
                                    </tr>
                                    <tr class="customerName" style="width: 80%">
                                      <td>
                                        <h2 style="color: #03A9F4; font-size: 15px; font-weight: 400; line-height: 1.2; margin: 5px 20px; text-align: left" align="left">Dear '.$customername.',</h2>
                                      </td>
                                    </tr>
                                    <tr class="openingGreeting" style="width: 80%">
                                      <td style="padding: 15px 20px; text-align: left" align="left">
                                        There is an issue with your package.
                                      </td>
                                    </tr>
                                    <tr style="width: 80%">
                                      <td class="space" style="padding: 8px 20px">
                                        <span class="heading" style="font-weight: bolder">Description: </span>'.$itemtype.'
                                      </td>
                                    </tr>
                                    <tr style="width: 80%">
                                      <td class="space" style="padding: 8px 20px">
                                        <span class="heading" style="font-weight: bolder">Shipped by: </span>'.$shippingcarrier.'
                                      </td>
                                    </tr>

                                    <tr style="width: 80%">
                                      <td class="space" style="padding: 8px 20px">
                                        <span class="heading" style="font-weight: bolder">Tracking: </span>'.$trackingnumber.'
                                      </td>
                                    </tr>

                                    <tr style="width: 80%">
                                      <td class="space" style="padding: 8px 20px">
                                        <span class="heading" style="font-weight: bolder">Issue: </span>'.$mainissue.'
                                      </td>
                                    </tr>

                                    ';


                        // Prepare the email body
                        if(isset($_POST['emailBody']) && $_POST['emailBody'] != "" && $_POST['sendEmail'] == "custom")
                        {
                          $body=
                          '<tr style="width: 80%">
                            <td class="space" style="padding: 8px 20px">'.
                              $_POST['emailBody'].'
                            </td>
                          </tr>
                        ';
                        }

                        else if($_POST['sendEmail'] == "auto")
                        {

                                          $body ='<br>';

                        }


                                                                  $footer='
                                                                  <tr style="width: 80%">
                                                                    <td class="space" style="padding: 8px 20px">
                                                                      <p>
                                                                        Please click <a href="#" title="Resolve this issue">here</a> to view more details and to resolve this issue.
                                                                      </p>
                                                                    </td>
                                                                  </tr>

                                                                    <tr class="openingGreeting" style="width: 80%">
                                                                      <td class="space" style="padding: 15px 20px; text-align: left" align="left">
                                                                        We thank you for your continued support
                                                                        <h2 class="closingStatement" style="color: #000; font-size: 15px; font-weight: bolder; line-height: 1.2; margin: 5px auto; text-align: left" align="left">Regards,</h2>
                                                                        <h2 class="closingStatement" style="color: #000; font-size: 15px; font-weight: bolder; line-height: 1.2; margin: 5px auto; text-align: left" align="left">Web Source</h2>
                                                                      </td>
                                                                    </tr>

                                                  </div>


                                                </table>

                                                </body>
                                                </html>';
                                                $fullEmailContent = $header.$body.$footer;
                                                // $body = $autoText;

                        if(isset($_POST['emailBody']) && $_POST['sendEmail'] != "no")
                        {
                          $subject = "There's a problem with your package(s)";
                          $from = "info@shipwebsource.com";
                          $to = "kenice1@gmail.com";
                          $replyTo = "customerservice@shipwebsource.com";
                          $errors.= composeEmail($from, $to, $subject, $replyTo, $fullEmailContent);

                        }


                    }


                    else
                    {
                      $sql = "DELETE from packages WHERE PackageID=:PackageID";

                    //prepare the sql statement
                    $stmt = $connection->prepare($sql);

                    // bind variables to the paramenters ? present in sql
                    $stmt->bindParam(':PackageID', $last, PDO::PARAM_INT);

                    //execute the prepared statement
                    $stmt->execute();


                    goto end;

                    }

                }



            }
            $errors.='done';
            echo $errors;
          }

          end:
          echo '';




          $connection = null;






?>
