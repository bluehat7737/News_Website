<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                    if(isset($_GET['search'])){
                        $search_term = $_GET['search'];
                ?>
                <div class="post-container">
                <h2 class="page-heading">Secrch : <?php echo $search_term; ?></h2>
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
                            WHERE post.title LIKE '%{$search_term}%' or post.description LIKE '%{$search_term}%'
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
                                            <a href='category.php?id=<?php echo $row['category_id']; ?>'><?php echo $row['category_name']; ?></a>
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
                    $sql1 = "SELECT * FROM post where title LIKE '%{$search_term}%';";
                    $result1 = mysqli_query($conn, $sql1) or die("Query sql1 died");

                    if (mysqli_num_rows($result1) > 0) {
                        $total_records = mysqli_num_rows($result1);

                        $total_pages = ceil($total_records / $limit);
                        echo '<ul class="pagination admin-pagination">';
                        if ($page > 1) {
                            echo '<li><a href="author.php?search='.$search_term.'&page=' . ($page - 1) . '"><<</a></li>';
                        }
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if ($i == $page) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                            echo '<li class="' . $active . '"><a href="author.php?search='.$search_term.'&page=' . $i . '">' . $i . '</a></li>';
                        }
                        if ($page < $total_pages) {
                            echo '<li><a href="author.php?search='.$search_term.'&page=' . ($page + 1) . '">>></a></li>';
                        }
                        echo '</ul>';
                    }
                }
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
