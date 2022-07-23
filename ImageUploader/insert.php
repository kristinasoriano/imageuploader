<?php 

// Creating Database Connection, used to put data of this PHP file into another PHP files
include('database.php');


// Create function
	if(isset($_POST['submit']))
  	{

// Getting the post values from the image table
    $title=$_POST['title'];
    $thumbnail=$_FILES["image"]["name"];
    $filename=$_POST['filename'];
   
// Getting the image extension
	$extension = substr($thumbnail,strlen($thumbnail)-4,strlen($thumbnail));

// Image upload allowed extensions
	$allowed_extensions = array(".jpg","jpeg",".png",".gif");

// Validation for allowed extensions .in_array() function searches an array for a specific value.
	if(!in_array($extension,$allowed_extensions))
	{
	echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed.');</script>";
	}
	else
	{

// Rename the image file
	$imgfile=$filename;
	$imgnewfile=md5($imgfile).time().$extension;

// Code for moving the image into directory
	move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$imgnewfile);

// Query for data insertion
	$query=mysqli_query($con, "insert into imagetable(Title, Thumbnail, FileName) value('$title', '$imgnewfile', '$filename')");
	if ($query) {
	echo "<script>alert('You have successfully inserted the data');</script>";
	echo "<script type='text/javascript'> document.location ='index.php'; </script>";
	} else{
	echo "<script>alert('Something Went Wrong. Please try again');</script>";
	}}
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
	<h1 class="project-name"><b>Image</b> Uploader</h1>
	<div class="container">
		<div class="wrapper">
			<form  method="POST" enctype="multipart/form-data" >

				<div class="header">
					<h2>Fill Image Data</h2>
					<hr>
				</div>

				<div class="form-wrapper center">
					<p>Fill below form for your image details</p>
					
					<div class="center">
						<div>
							<input type="text" name="title" placeholder="Title" required="true" class="form-input"> 	
						</div> 
							<input type="file"  name="image"  required="true" class="margin">
							<p class="yellow-text">Only jpg / jpeg/ png /gif format allowed.</p>
					</div>

					<div class="center">
						<input type="text" name="filename" placeholder="Filename" required="true" class="form-input">
					</div>
				
					<div>
						<button type="submit" class="button-white" name="submit">SUBMIT</button>
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