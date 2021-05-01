<?php
    // $title = $_SERVER['PHP_SELF'];
    // $title = explode('/', $title);
    // $title = end($title);
    // $title = explode('.', $title);
    // $title = ucfirst($title[0]);
    include "config.php";
    $page = basename($_SERVER['PHP_SELF']);
    switch ($page){
        case "single.php":
            if(isset($_GET['id'])){
                $sql_title = "SELECT * FROM post WHERE post_id = {$_GET['id']}";
                $result_title = mysqli_query($conn, $sql_title);
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['title'] . " News";
            }else{
                $page_title = "No Post found.";
            }
        break;
        case "category.php":
            if(isset($_GET['id'])){
                $sql_title = "SELECT * FROM category WHERE category_id = {$_GET['id']}";
                $result_title = mysqli_query($conn, $sql_title);
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['category_name'] . " News";
            }else{
                $page_title = "No Post found.";
            }
        break;
        case "author.php":
            if(isset($_GET['aid'])){
                $sql_title = "SELECT * FROM user WHERE user_id = {$_GET['aid']}";
                $result_title = mysqli_query($conn, $sql_title);
                $row_title = mysqli_fetch_assoc($result_title);
                $page_title = $row_title['username'] . "'s News";
            }else{
                $page_title = "No Post found.";
            }
        break;
        case "search.php":
            if(isset($_GET['search'])){
                $page_title = $_GET['search']  . " News";
            }else{
                $page_title = "No Post found.";
            }
        break;
        default:
            $page_title = "Main";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $page_title ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
                include "config.php";
                if(isset($_GET['id'])){
                    $cat_id = $_GET['id'];
                }
                $sql = "SELECT * FROM category WHERE post > 0";
                $result = mysqli_query($conn,$sql) or die(mysqli_error($sql));
                if(mysqli_num_rows($result) > 0){
                    $active = "";
            ?>
                <ul class='menu'>
                <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <?php
                        if(isset($cat_id)){
                            if($row['category_id'] == $cat_id){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                        }
                    ?>
                    <li><a class='<?php echo $active; ?>' href='category.php?id=<?php echo $row['category_id']; ?>'><?php echo strtoupper($row['category_name']); ?></a></li>
                <?php } ?>  
                </ul>
            <?php    
                }
            ?>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
