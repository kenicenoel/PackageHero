<?php
include_once "config.php";

          if(isset($_FILES['images']) && isset($_POST['trackingnumber']))
          {

            $sql = "INSERT INTO packages(TrackingNumber, CustomerName, MainIssue, Description, ItemType, ShippingCarrier ) VALUES(?,?,?,?,?,?)";

                //prepare the sql statement
                $stmt = $connection->prepare($sql);

                // bind variables to the paramenters ? present in sql
                $stmt->bind_param('ssssss', $trackingnumber,$customername, $mainissue, $description, $itemtype, $shippingcarrier);

                //set the variables from form values
                $trackingnumber= $_POST['trackingnumber'];
                $customername = $_POST['customername'];
                $mainissue = $_POST['MainIssue'];
                $description = $_POST['description'];
                $itemtype = $_POST['itemtype'];
                $shippingcarrier = $_POST['shippingcarrier'];

                //execute the prepared statement
                $stmt->execute();

            $images = $_FILES['images'];
            $i=1;
            $last = $stmt->insert_id;


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
                    echo "One or more images are larger than 50MB. Try again.";
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
                  $sql = "DELETE from packages WHERE PackageID=?";

                    //prepare the sql statement
                    $stmt = $connection->prepare($sql);

                    // bind variables to the paramenters ? present in sql
                    $stmt->bind_param('i', $last);

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
                      $sql = "UPDATE packages SET Photo{$i}= ? WHERE PackageID=?";

                        //prepare the sql statement
                        $stmt = $connection->prepare($sql);

                        // bind variables to the paramenters ? present in sql
                        $stmt->bind_param('si', ${'image'.$i}, $last);
                        ${'image'.$i} = $target_file;

                        //execute the prepared statement
                        $stmt->execute();
                        $i++;
                    }

                    else
                    {
                      $sql = "DELETE from packages WHERE PackageID=?";

                    //prepare the sql statement
                    $stmt = $connection->prepare($sql);

                    // bind variables to the paramenters ? present in sql
                    $stmt->bind_param('i', $last);

                    //execute the prepared statement
                    $stmt->execute();


                    goto end;

                    }




                }



            }
            echo 'Done';
          }

          end:
          echo '';



          $stmt->close();
          $connection->close();






?>
