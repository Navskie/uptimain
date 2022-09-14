<?php include 'include/header.php'; ?>

<?php
    $SCode = $_SESSION['code'];
    
    $check_stockist = "SELECT * FROM stockist WHERE stockist_code = '$SCode'";
    $check_stockist_qry = mysqli_query($connect, $check_stockist);
    $check_stockist_num = mysqli_num_rows($check_stockist_qry);
    
    if ($check_stockist_num > 0) {
      header('location: stockist.php');
  } else {  ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>
<!-- Pop Up Image -->
<?php } ?>
<style>
  .popup {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none;
    z-index : 50;
  }
  .contentBox {
    background: #fff;
    border-radius: 20px;
    padding: 20px;
    
  } 
  .contentBox > img {
    position: relative;
    width: 500px;
    height: 500px;
    background-color: #fff;
    display:flex;
  }
  .close {
    position: absolute;
    top: 20px;
    right: 20px;
    width: 40px;
    height: 40px;
    cursor: pointer;
    /* border-radius: 50%; */
    z-index: 100;
  }
  .close > img {
    background-color: #fff;
  } 

  @media (max-width: 768px) {
    .contentBox > img {
      width: 350px;
      height: 350px;
    }
    .contentBox {
    background: #fff;
    border-radius: 10px;
    padding: 10px;
    
  }
  }
</style>

<?php
  date_default_timezone_set('Asia/Manila');
  $month = date('m');
  $monthName = date("F", mktime(0, 0, 0, $month, 10));
  $year = date('Y');
  $day = date('d');
  $date1 = $month.'-01-'.$year;
  $date2 = date('m-d-Y'); 
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
      
    <?php 
      $myid = $_SESSION['code'];
      
      $check_position = "SELECT * FROM upti_users WHERE users_code = '$myid'";
      $check_position_qry = mysqli_query($connect, $check_position);
      $check_fetch = mysqli_fetch_array($check_position_qry);

      $emp_position = $check_fetch['users_position'];

    ?>
        <!-- START HERE -->
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-3 col-md-6 col-sm-12">
          <div class="course">
            <div class="preview bg-success">
              <h2 class="text-center"><i class="uil uil-check-circle"></i></h2>
            </div>

            <div class="info">
              <h6>DELIVERED ORDERS</h6>
              <h2><b>TEST</b></h2>
            </div>
          </div>
          <br>
        </div>

      </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
      
  </div>
<?php include 'include/footer.php'; ?>