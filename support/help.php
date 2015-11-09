<?php
include_once "config.php";

$moduleName = "Create New Issue";

if(isset($_POST['trackingnumber']))
{
    $sql = "INSERT INTO packages(TrackingNumber, CustomerName, MainIssue, Description) VALUES(?,?,?,?)";

          //prepare the sql statement
          $stmt = $connection->prepare($sql);

          // bind variables to the paramenters ? present in sql
          $stmt->bind_param('ssss', $trackingnumber,$customername, $mainissue, $description);

          //set the variables from form values
          $trackingnumber= $_POST['trackingnumber'];
          $customername = $_POST['customername'];
          $mainissue = $_POST['MainIssue'];
          $description = $_POST['description'];

          //execute the prepared statement
          $stmt->execute();

          if(isset($_FILES['images']['name'][0]))
          {
            $images = $_FILES['images'];
            $i=1;
            $last = $stmt->insert_id;


            foreach($images['name'] as $position => $data)
            {
              $target_dir = "uploads/";
              $target_file = $target_dir . basename($_FILES["images"]["name"][$position]);
              $uploadOk = 1;
              $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

              // Check if image file is a actual image or fake image

                  $check = getimagesize($images["tmp_name"][$position]);
                  if($check !== false)
                  {
                      $uploadOk = 1;
                  }
                  else
                  {
                      echo "File is not an image.";
                      $uploadOk = 0;
                  }
                  // Check if file already exists
                  if (file_exists($target_file))
                  {
                      echo "One or more images already exist.";
                      $uploadOk = 0;

                  }
                // Check file size to ensure it is not larger than 50MB
                if ($images["size"][$position] > 50000000)
                {
                    echo "Sorry, one or more images are larger than 50MB.";
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
            echo 'Successfully added package!';
          }

          end:
          echo '';



          $stmt->close();
          $connection->close();




}

else
{
  echo '






    <form class="card" id="package" enctype="multipart/form-data" method = "post" action = "includes/addpackage.php">
          <br>
          <header class="subheading"><span class="fa fa-plane"> </span> Add a new package with issues to the system </header>
          <p id="errorMessage"></p>
          <p>
            Enter the tracking number, customer name (if known) and pick a main issue. <br>Enter a description if additional information is known or
            the issue is not listed<br> in the main issue dropdown.
          </p>
          <br><br>
          <label for="trackingnumber">Tracking Number</label>
          <input type = "text" id = "trackingnumber" name="trackingnumber" /><br>

          <label for="customername">Customer Name</label>
          <input type = "text" id = "customername" name="customername" /><br>

          <label for="type">Main Issue</label>
            <select form="package" name="MainIssue"> <br>
              <option disabled selected>Select an issue</option>
              <option value = "Broken">Received broken</option>
              <option value = "Cannot identify customer">Cannot identify customer</option>
              <option value = "Invoice required">Invoice required</option>
              <option value = "Delivery address not known">Delivery address not known</option>

            </select><br>


          <textarea rows="10" cols="70" form="package" id = "description" name="description"
          required placeholder = "Enter issues for this package" wrap="hard">
          </textarea> <br>

          <label for="images"> Pick Images (MAX: 5)</label>
          <input type = "file" id = "images" name="images[]" accept=".jpg" multiple> <br>
          <input id="upload" type = "submit" value="Add" />

      </form>
 ';

}

?>
