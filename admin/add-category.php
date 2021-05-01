<?php 
    include "header.php"; 
    if($_SESSION['user_role'] == '0'){
    header("{$hostname}/admin/post.php");
    } 
?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <?php
                    include "config.php";
                    if(isset($_POST['save'])){
                        $cat_name = $_POST['cat'];
                        $sql = "INSERT INTO category(category_name) values('{$cat_name}')";
                        $result = mysqli_query($conn, $sql) or die("Query sql die");
                        header("{$hostname}/admin/category.php");
                        mysqli_close($conn);
                    }
                  ?>
                  <form action=" <?php $_SERVER['PHP_SELF'] ?> " method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
