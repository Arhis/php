<?php

/* 
 * This is a file uploader, it uploads a file on server and change
 * its name to an order number that began from 1. The main idea is that 
 * all uploaded files on the server will be numbered by their names.
 */

echo <<<_END
<!DOCTYPE html>
<html>
<head>
    <title>Upload One</title>
</head>
<body>
<form method = 'post' action = 'upload_two.php' enctype = 'multipart/form-data'>
Загрузить: <input type = 'file' name = 'filename' size = '10'><br><br>
<input type = 'submit' value = 'Загрузить'>
</form>
_END;

if($_FILES)
{
    $form_name = $_FILES['filename']['name']; //gettring name of file from form
    $file_extension = end(explode(".", $form_name)); //devide file name to two parts before and after the dot to extract extension of it
    
    /*Giving the name of uploaded file (from 1 to ...)*/
    $give_name = 1; 
    
    /*loop that check of exsistance of the file, if TRUE name changing on 1 one more*/
    while(file_exists(sprintf("%02s", $give_name).".".$file_extension))
    {
        ++$give_name;
    }
    
    $final_name = sprintf("%02s", $give_name).".".$file_extension;  //we got final name of file
    move_uploaded_file($_FILES['filename']['tmp_name'], $final_name); //saving file with given name to hard driver
    $file_size = $_FILES['filename']['size'];
    
    echo "Загружаемое изображение: '"
       . "$final_name' и его размер = $file_size bytes <br>"
       . "<img src='$final_name'>";
}

