<?php include "header.php";
    
    if($_SESSION['user_role'] == '0'){
      header("{$hostname}/admin/post.php");
    }
    include "config.php";
    if(isset($_POST['update'])){
        $catName = $_POST['cat_name'];
        $sql = "UPDATE category SET category_name = '{$catName}' WHERE category_id = '{$_GET['id']}'";
        if(mysqli_query($conn, $sql)){
            header("{$hostname}/admin/category.php");
            mysqli_close($conn);
        } 
    }
 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="1" placeholder="">
                      </div>
                      <?php
                          $cat_id = $_GET['id'];
                          $sql = "SELECT * FROM category WHERE category_id = '{$cat_id}'";
                          $result = mysqli_query($conn, $sql) or die(mysqli_error($sql));
                          if(mysqli_num_rows($result)>0){
                              while($row = mysqli_fetch_assoc($result)){
                      ?>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                      }
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
