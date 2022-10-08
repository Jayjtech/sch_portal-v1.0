<?php
require "../config/db.php";
require "../includes/calls.php";
function compressImage($source, $destination, $quality) { 
    // Get image info 
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Create a new image from file 
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
     
    // Save image 
    imagejpeg($image, $destination, $quality); 
     
    // Return compressed image 
    return $destination; 
} 
 
 
// File upload path 
$uploadPath = "../images/"; 
// If file upload form is submitted 
$status = $statusMsg = ''; 
    $status = 'error'; 
    if($_FILES["logo_file"]["name"] != '') { 
        $img_size = $_FILES['logo_file']['size'];
            // File info 
            $code = rand(100, 999);
            $fileName = basename($_FILES["logo_file"]["name"]);
            $target_file = $fileName;
            $imageUploadPath = $uploadPath . $fileName; 
            $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
            
            // Allow certain file formats 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes)){ 
                // Image temp source 
                $imageTemp = $_FILES["logo_file"]["tmp_name"]; 
                
                $selectProImage = $conn->query("SELECT img FROM $settings_tbl");
                    while($row = $selectProImage->fetch_assoc()){
                        $logo = $row['img'];
                    }
                    $path = '../images/'.$logo.'';
                        unlink($path); 
                // Compress size and upload image 
                $compressedImage = compressImage($imageTemp, $imageUploadPath, 15); 
                if($compressedImage){ 
                    $query = $conn->query("UPDATE $settings_tbl SET img='$target_file'");
                    if($query){
                        $status = 'success'; 
                        $statusMsg = '<div class="alert alert-danger">Image uploaded successfully.</div>';
                    }
                }else{ 
                    $statusMsg = "Image compress failed!"; 
                } 
            }else{ 
                $statusMsg = '<div class="alert alert-danger">Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.</div>'; 
            } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
    $_SESSION['image'] = $target_file;

echo '<div class="wrapper" style="background: url(images/'.$target_file.'); height:150px;width:150px;position:relative;border:5px solid #fff;
border-radius: 50%;background-size: 100% 100%;margin: 0px auto;overflow:hidden;">
<input type="file" name="file" id="file" class="my_file">
</div>
';
?>