<?php
include_once '../db_connectionn.php';
if (isset($_POST['save'])) {
    $uID = $connection->real_escape_string($_POST['uID']);
    $ratedIndex = $connection->real_escape_string($_POST['ratedIndex']);
    $ratedIndex++;

    if (!$uID) {
        $connection->query("INSERT INTO stars (rateIndex) VALUES ('$ratedIndex')");
        $sql = $connection->query("SELECT id FROM stars ORDER BY id DESC LIMIT 1");
        $uData = $sql->fetch_assoc();
        $uID = $uData['id'];
    } else
        $connection->query("UPDATE stars SET rateIndex='$ratedIndex' WHERE id='$uID'");

    exit(json_encode(array('id' => $uID)));
}

$sql = $connection->query("SELECT id FROM stars");
$numR = $sql->num_rows;

//$sql = $connection->query("SELECT SUM(rateIndex) AS total FROM stars");
//$rData = $sql->fetch_array();
//$total = $rData['total'];

?>
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

  <?php
  include_once "../db_connectionn.php";

  $id = $_GET['id'];

  $qurey = "SELECT * from store where category_id = '$id'";
  $result = mysqli_query($connection,$qurey);
  if ($result){

  }else{
      echo "ffffffffffffffffffffff";
  }

//
//  $row = mysqli_fetch_assoc($result);
//  $id = $row['id'];
//  $name = $row['name'];
//  $phone = $row['phone'];
//  $Logo = $row['Logo'];
//  $address = $row['address'];
//  $newname= $Logo;

  if (mysqli_num_rows($result)>0){
      while ($row = mysqli_fetch_assoc($result)){
          $id = $row['id'];
          $name = $row['name'];
          $phone = $row['phone'];
          $Logo = $row['Logo'];
          $address = $row['address'];
          $newname= $Logo;
             echo "
  <div class='container-fluid page-body-wrapper full-page-wrapper'>
      <div class='content-wrapper full-page-wrapper d-flex  auth login-bg'>
          <div class='col-12 grid-margin'>
              <div class='page-header'>
                  <h3 class='page-title'> stores of category </h3>
                  <form action='searchdb.php' method='post'>
                  </form>
              </div>
              <div class='col-3 grid-margin'>
              <div class='card'>
              <div class='card-body'>
                <img style='margin-bottom: 15px' class='img-fluid' height='300px' width='300px' src= '../dashboard/uploads/$newname' alt='Store Icone'/>
                  <h4 class='card-title'><p>store name : </p>$name</h4>
                  <div class='text-end pt-1'>
                      <p class='text-sm mb-0 text-capitalize'><p>phone number : </p>$phone</p>
                      <h4 class='mb-0'><p>address : </p>$address</h4>

                  </div>
            </div>
                  <hr class='dark horizontal my-0'>
                  <div class='card-footer p-3'>
                      <p class='mb-0'>
                      <div style='color:white;'>
                          <i class='fa fa-star fa' data-index='0'></i>
                          <i class='fa fa-star fa' data-index='1'></i>
                          <i class='fa fa-star fa' data-index='2'></i>
                          <i class='fa fa-star fa' data-index='3'></i>
                          <i class='fa fa-star fa' data-index='4'></i>
                      </div>
                      </p>
                  </div>
              </div>
              </div>
                    </div>

                  </div>

          <!-- content-wrapper ends -->
        </div>
        <!-- row ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div> "; }
  }

  ?>

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
    <script src="https://kit.fontawesome.com/92deba682b.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
      var ratedIndex = -1, uID = 0;

      $(document).ready(function () {
          resetStarColors();

          if (localStorage.getItem('ratedIndex') != null) {
              setStars(parseInt(localStorage.getItem('ratedIndex')));
              uID = localStorage.getItem('uID');
          }

          $('.fa-star').on('click', function () {
              ratedIndex = parseInt($(this).data('index'));
              localStorage.setItem('ratedIndex', ratedIndex);
              saveToTheDB();
          });

          $('.fa-star').mouseover(function () {
              resetStarColors();
              var currentIndex = parseInt($(this).data('index'));
              setStars(currentIndex);
          });

          $('.fa-star').mouseleave(function () {
              resetStarColors();

              if (ratedIndex != -1)
                  setStars(ratedIndex);
          });
      });

      function saveToTheDB() {
          $.ajax({
              url: "test10.php",
              method: "POST",
              dataType: 'json',
              data: {
                  save: 1,
                  uID: uID,
                  ratedIndex: ratedIndex
              }, success: function (r) {
                  uID = r.id;
                  localStorage.setItem('uID', uID);
              }
          });
      }

      function setStars(max) {
          for (var i=0; i <= max; i++)
              $('.fa-star:eq('+i+')').css('color', 'yellow');
      }

      function resetStarColors() {
          $('.fa-star').css('color', 'white');
      }
  </script>

      <!-- endinject -->
  </body>
</html>