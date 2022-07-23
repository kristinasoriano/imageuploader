<?php

// Creating Database Connection, used to put data of this PHP file into another PHP files
include('database.php');

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
       
            <div class="header">
                <div class="title">                   
                    <h2>View Image</h2>
                </div>
                        <?php
                        $vid=$_GET['viewid'];
                        $ret=mysqli_query($con,"select * from imagetable where ID =$vid");
                        $cnt=1;
                        while ($row=mysqli_fetch_array($ret)) {
                        ?>

                
                <hr> 
            </div>
            

            <div class="table-style">
                <table>
                    <tbody>
                        <tr>
                            <th><img src="images/<?php  echo $row['Thumbnail'];?>" class="images"></th>
                        </tr>
                        <tr>
                            <th class="head-title-grey center">Uploaded Image</th>
                        </tr>
                    </tbody>
                </table>

                <div class="center">
                    <a href="edit.php?editid=<?php echo htmlentities ($row['ID']);?>" class="button"><span>Edit Image Details</span></a>                    
                </div>

                <table>
                    <tbody>

                        <tr>
                            <th>Date Added</th>
                            <td><?php  echo $row['DateAdded'];?></td>
                        </tr>


                        <tr>
                            <th>Title</th>
                            <td><?php  echo $row['Title'];?></td>
                        </tr>

                     
                        <tr>
                            <th>File Name</th>
                            <td><?php  echo $row['FileName'];?></td>
                        </tr>
                 
            
                        <?php 
                        $cnt=$cnt+1;
                        }?>
                            
                    </tbody>
                </table>
            </div>
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