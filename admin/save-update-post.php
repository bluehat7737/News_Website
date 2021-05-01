<?php
    include "config.php";

    if(empty($_FILES['new-image']['name'])){
        $new_name = $_POST['old-image'];
    }else{
        $error = array();

        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_temp = $_FILES['new-image']['tmp_name'];
        $file_type = $_FILES['new-image']['type'];
        $file_ext = strtolower(end(explode('.',$file_name)));
        $extension = array('jpeg', 'jpg', 'png');

        if(!in_array($file_ext, $extension)){
            $error[] = "This extention file is not allowed! Please choose jpeg, PNG, jpg.";
        }

        if($file_size > 2097152){
            $error[] = "File size must be 2 MB or lower.";
        }

        $new_name = time()."-".basename($file_name);
        $target = "upload/".$new_name;
        $img_name = $new_name;
        if(empty($error)){
            move_uploaded_file($file_temp, $target);
        }else{
            print_r($error);
            die();
        }
    }
    $sql = "UPDATE post SET title='{$_POST["post_title"]}', description='{$_POST["postdesc"]}', category={$_POST["category"]}, post_img='{$img_name}'
    WHERE post_id = {$_POST['post_id']};";
    if($_POST['old_category'] != $_POST['category']){
        $sql .= "UPDATE category SET post = post-1 WHERE category_id={$_POST['old_category']};";
        $sql .= "UPDATE category SET post = post+1 WHERE category_id={$_POST['category']};";
    } 
    // echo $sql;
    // die();
    $result = mysqli_multi_query($conn,$sql) or die(mysqli_error($sql));
    if($result){
        header("{$hostname}/admin/post.php");
    }else{
        echo "Query Failed!";
    }
?>