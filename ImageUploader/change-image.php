<?php 

// Creating Database Connection, used to put data of this PHP file into another PHP files
include('database.php');

if(isset($_POST['submit']))
  {
$uid=$_GET['userid'];

// Getting the post values
  	$thumbnail=$_FILES["image"]["name"];
	$oldthumbnail=$_POST['oldimage'];
	$oldimage="images"."/".$oldthumbnail;

// Getting the image extension
	$extension = substr($thumbnail,strlen($thumbnail)-4,strlen($thumbnail));


// Image upload allowed extensions
	$allowed_extensions = array(".jpg","jpeg",".png",".gif");


// Validation for allowed image extensions .in_array() function searches an array for a specific value
	if(!in_array($extension,$allowed_extensions))
	{
		echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
		}
			else
	{

// Rename the image file
	$imgfile=$filename;
	$imgnewfile=md5($imgfile).time().$extension;

// Code for moving the image into directory
	move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$imgnewfile);

// Query for data insertion
     $query=mysqli_query($con, "update imagetable set Thumbnail='$imgnewfile' where id='$uid' ");
    if ($query) {
    	//Old pic
    	unlink($oldimage);
    echo "<script>alert('Image updated successfully');</script>";
    echo "<script type='text/javascript'> document.location ='index.php'; </script>";
  }
  	else
		{
		echo "<script>alert('Something went wrong. Please try again.');</script>";
		}
	}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Uploader App</title>

    <!--Favicon-->
    <link rel="icon" href="favicon.ico"/>

    <!--Google Fonts-->
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@700&family=Quicksand:wght@500&display=swap" rel="stylesheet">

    <!--CSS Stylesheet-->
    <link rel="stylesheet" href="css/style.css" />

    <!--Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--JQuery-->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
</head>

<body>
	<h1 class="project-name">Image Uploader</h1>
	<div class="container"> 
		<div class="wrapper">
			<form  method="POST" enctype="multipart/form-data">
				<?php
				$eid=$_GET['userid'];
				$ret=mysqli_query($con,"select * from imagetable where ID='$eid'");
					while ($row=mysqli_fetch_array($ret)) {
				?>

				<div class="header">
					<h2>Change Image</h2>
					<hr>
				</div>


				<div class="table-style">
					<table>
						<tr>
							<th><img src="images/<?php  echo $row['Thumbnail'];?>" class="images"></th>
						</tr>
					</table>
				</div>


				<div class="form-wrapper center">
					<p>Change your image</p>
					<input type="hidden" name="oldimage" value="<?php  echo $row['Thumbnail'];?>">
					
					<div class="wrapper">
						<input type="file" class="center-block" name="image"  required="true">
						
					</div>
					<p class="yellow-text">Only jpg / jpeg/ png /gif format allowed.</p>
					
				
					<div>
						<button type="submit" class="button-white" name="submit">Update</button>
					</div>

						<?php 
						}?>
				</div>
			</form>
					
			
		</div>
	</div>

	<div class="footer-wrapper">
        <div class="footer white">
            <img src="images/web_images/KS_Brand-White.png" class="logo-footer">
            <p class="footer-text"></p>Designed and developed by Kristina Soriano</p>
        </div>
    </div>


</body>
</html>