<?php
    include "config.php";
    $id = $_GET['id'];
    $cat_id = $_GET['catId'];

    $sql1 = "SELECT * FROM post WHERE post_id = {$id};";
    $result = mysqli_query($conn,$sql1) or die(mysqli_error($sql1));
    $row = mysqli_fetch_array($result);

    unlink("upload/".$row['post_img']);

    $sql = "DELETE FROM post WHERE post_id = {$id};";
    $sql .= "UPDATE category SET post = post-1 WHERE category_id = {$cat_id}";

    if(mysqli_multi_query($conn,$sql)){
        header("{$hostname}/admin/post.php"); 
        mysqli_close($conn);
    }else{
        echo "Query Failed";
    }

?>