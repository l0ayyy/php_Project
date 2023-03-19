<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
  </head>
  <body>
      <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper full-page-wrapper d-flex auth login-bg">
              <div class="col-12 grid-margin">
              <div class="card">
              <div class="card-body">
                  <h4 class="card-title">Categories</h4>
                  <div class="table-responsive">
                      <table class="table">
                          <thead>
                          <tr>
                              <th>Category Name</th>
                          </tr>
                          </thead>
                          <tbody>
                          <?php
                          include_once '../db_connectionn.php';
                          $limit = 3;
                          $page=$_GET['page'] ?? 1;
                          $offset = ($page-1)*$limit;
                          $query="SELECT * from category  ORDER BY id DESC 
                                Limit $limit offset $offset ";
                          $result =  mysqli_query($connection,$query);
                          if (mysqli_num_rows($result)  >0){
                              while ($row= mysqli_fetch_assoc($result)){
                                  $id  = $row['id'] ;
                                  $name = $row['name'] ;
                                  echo "        <tr>
        
                          <td><a href='stores.php?id=".$id."' class ='page-link'>$name</a></td>                         
                                                </form>
                                            </td></tr>";
                              }
                          }
?>



                          </tbody>
                      </table>
                      <div class="row">
                          <div class="col-12">
                              <?php
                              $query = "SELECT count(id) as row_no from category";
                              $result = mysqli_query($connection,$query);
                              $row = mysqli_fetch_assoc($result);
                              $page_count = ceil($row['row_no']/ $limit);
                              echo "<ul class='pagination'>";
                              for ($i =1;$i<=$page_count;$i++){
                                  echo "<li class='page-item'>
                                                    <a href='public.php?page=".$i."' class ='page-link'>$i</a></li>";

                              }


                              ?>
                              </tbody>
                              </table>
                          </div>
                        </div>
                    </div>
                  </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>