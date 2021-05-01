<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                    $id = $_GET['id'];
                    $sql1 = "SELECT * FROM category WHERE category_id = {$id};";
                    $result = mysqli_query($conn,$sql1);
                    $categoryName = mysqli_fetch_assoc($result);
                ?>
                <div class="post-container">
                <h2 class="page-heading"><?php echo $categoryName['category_name']; ?></h2>
                <?php
                    include 'config.php';
                    $limit = 3;
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;
                    $sql = "SELECT * FROM post
                            LEFT JOIN category ON category.category_id = post.category
                            LEFT JOIN user ON user.user_id = post.author
                            WHERE category.category_id = {$id}
                            ORDER BY post.post_id DESC LIMIT {$offset}, {$limit}";
                    $result = mysqli_query($conn,$sql) or die(mysqli_error($sql));
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php?id=<?php echo $row["post_id"]; ?>"><img src="admin/upload/<?php echo $row['post_img']; ?>" alt="<?php echo $row['post_img']; ?>"/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row["post_id"]; ?>'><?php echo $row['title']; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php'><?php echo $row['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?aid=<?php echo $row["author"]; ?>'><?php echo $row['username']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row['description'], 0, 130)."..."; ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row["post_id"]; ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>
                
                <?php
                    $sql1 = "SELECT * FROM post where category = {$id};";
                    $result1 = mysqli_query($conn, $sql1) or die("Query sql1 died");

                    if (mysqli_num_rows($result1) > 0) {
                        $total_records = mysqli_num_rows($result1);

                        $total_pages = ceil($total_records / $limit);
                        echo '<ul class="pagination admin-pagination">';
                        if ($page > 1) {
                            echo '<li><a href="category.php?id='.$id.'&page=' . ($page - 1) . '"><<</a></li>';
                        }
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                            echo '<li class="' . $active . '"><a href="category.php?id='.$id.'&page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($page < $total_pages) {
                            echo '<li><a href="category.php?id='.$id.'&page=' . ($page + 1) . '">>></a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
