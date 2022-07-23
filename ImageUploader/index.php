<?php


// Creating Database Connection, used to put data of this PHP file into another PHP files
include('database.php');



// Delete function to check if the variable has been set or declared
        if(isset($_GET['delid']))
        {
        $rid=intval($_GET['delid']);                                     // Return id 
        $image=$_GET['thumbnail']; 
        $imagepath="images"."/".$image;                                 // Path of the image folder where the images uploaded are stored
        $sql=mysqli_query($con,"delete from imagetable where ID=$rid"); // Deleting image in the imagetable(sql database)
        unlink($imagepath);
        echo "<script>alert('Image has been deleted.');</script>"; 
        echo "<script>window.location.href = 'index.php'</script>";     // Returning back to index.php   
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

            <div class="header">
                <div class="title">                   
                    <h2>Upload File</h2>
                </div>

                <div>
                    <a href="insert.php"><img class="upload-icon" src="images/web_images/upload-icon.png">
                    <br><span class="button">Upload New Image</span></a>              
                </div>
                <hr> 
            </div>
        
           
            <div class="table-style">
                <table>
                    <thead>
                        <tr class="head-title-green">
                            <th class="table-col">Title</th>
                            <th class="table-col">Thumbnail</th>
                            <th class="table-col">File Name</th>                       
                            <th class="table-col">Created Date</th>
                            <th class="table-col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ret=mysqli_query($con,"select * from imagetable");     // Return to the image table
                    $cnt=1;
                    $row=mysqli_num_rows($ret);
                        if($row>0){
                        while ($row=mysqli_fetch_array($ret)) {

                        ?>
                        <!--Fetch the Records -->
                                            <tr>
                                                <td><?php  echo $row['Title'];?></td> 
                                                <td><img src="images/<?php  echo $row['Thumbnail'];?>" width="80" height="80"></td>
                                                <td><?php  echo $row['FileName'];?></td>                        
                                                <td> <?php  echo $row['DateAdded'];?></td>
                                                <td>
                                                <a href="read.php?viewid=<?php echo htmlentities ($row['ID']);?>" class="view" title="View" data-toggle="tooltip"><img class="action-icons" src="images/web_images/img-view.png"></a>
                                                    <a href="edit.php?editid=<?php echo htmlentities ($row['ID']);?>" class="edit" title="Edit" data-toggle="tooltip"><img class="action-icons" src="images/web_images/img-edit.png"></a>
                                                    <a href="index.php?delid=<?php echo ($row['ID']);?>&&thumbnail=<?php echo $row['Thumbnail'];?>" class="delete" title="Delete" data-toggle="tooltip" onclick="return confirm('Do you really want to delete this file?');"><img class="action-icons" src="images/web_images/img-delete.png"></a>
                                                </td>
                                            </tr>
                                            <?php 
                        $cnt=$cnt+1;
                        } } else {?>
                        <tr>
                            <th style="text-align:center; color:red;" colspan="6">No Image Record Found</th>
                        </tr>
                        <?php } ?>                 
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