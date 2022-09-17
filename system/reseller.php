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
    <div class="row">

<div class="col-lg-4 col-md-6 col-sm-12">
  <div class="course">
    <div class="preview" style="background: #2771D0;">
      <h2 class="text-center text-light"><i class="uil uil-plane-departure"></i></h2>
    </div>

    <div class="info">
      <h6>Boracay Travel Incentive</h6>
      <h2><b><?php echo number_format($reward_sales) ?> / 400,000</b></h2>
      <p class="text-danger pt-2">1 Ticket for every 400,000 sales (April - July)</p>
    </div>
  </div>
  <br>
</div>

<div class="col-lg-4 col-md-6 col-sm-12">
  <div class="course">
    <div class="preview" style="background: #2771D0;">
      <h2 class="text-center text-light"><i class="uil uil-plane-departure"></i></h2>
    </div>

    <div class="info">
      <h6>Boracay Travel Incentive</h6>
      <h2><b><?php echo number_format($reward_sales1) ?> / 400,000</b></h2>
      <p class="text-danger pt-2">1 Ticket for every 400,000 sales (August - October)</p>
    </div>
  </div>
  <br>
</div>

</div>
<div class="row">
      <?php
        $total_points = "SELECT reseller_points FROM upti_reseller WHERE reseller_code = '$myid'";
        $total_sql_points = mysqli_query($connect, $total_points);
        $total_fetch_points = mysqli_fetch_array($total_sql_points);
      ?>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="course">
          <div class="preview bg-info">
            <h2 class="text-center"><i class="uil uil-coins"></i></h2>
          </div>

          <div class="info">
            <h6>Reseller Points</h6>
            <h2><b><?php echo $total_fetch_points['reseller_points'] ?></b></h2>
            <!-- <a href="branch-rts-order.php" class="text-info">MORE INFO </a> -->
          </div>
        </div>
        <br>
      </div>

      <?php
        $total_points_sql = "SELECT SUM(upti_order_list.ol_php) AS total FROM upti_order_list INNER JOIN upti_activities ON upti_order_list.ol_poid = upti_activities.activities_poid WHERE upti_order_list.ol_reseller = '$myid' AND upti_activities.activities_caption = 'Order Delivered'";
        $total_sql_points_sql = mysqli_query($connect, $total_points_sql);
        $total_fetch_points_sql = mysqli_fetch_array($total_sql_points_sql);
      ?>
      <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="course">
          <div class="preview bg-success">
            <h2 class="text-center"><i class="uil uil-dollar-sign-alt"></i></h2>
          </div>

          <div class="info">
            <h6>total sales</h6>
            <h2><b>₱ <?php echo $tote = $total_fetch_points_sql['total'] ?></b></h2>
            <!-- <a href="branch-rts-order.php" class="text-info">MORE INFO </a> -->
          </div>
        </div>
        <br>
      </div>
    </div>
    <hr><br>
    <div class="row">
      <?php
        if ($emp_position != '') {
          $total = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_my_reseller = '$myid'";
          $total_sql = mysqli_query($connect, $total);
          $total_fetch = mysqli_fetch_array($total_sql);
        } else {
          $total = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_seller = '$myid' OR trans_my_reseller = '$myid'";
          $total_sql = mysqli_query($connect, $total);
          $total_fetch = mysqli_fetch_array($total_sql);
        }
      ?>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="course">
          <div class="preview bg-warning">
            <h2 class="text-center"><i class="uil uil-shopping-cart-alt"></i></h2>
          </div>

          <div class="info">
            <h6>TOTAL ORDERS</h6>
            <h2><b><?php echo $total_fetch['total'] ?></b></h2>
            <a href="my-order.php" class="text-info">MORE INFO </a>
          </div>
        </div>
        <br>
      </div>

      <?php
        if ($emp_position != '') {
          $pending = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_my_reseller = '$myid' AND trans_status = 'Pending'";
          $pending_sql = mysqli_query($connect, $pending);
          $pending_fetch = mysqli_fetch_array($pending_sql);
        } else {
          $pending = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_seller = '$myid' AND trans_status = 'Pending'";
          $pending_sql = mysqli_query($connect, $pending);
          $pending_fetch = mysqli_fetch_array($pending_sql);
        }
      ?>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="course">
          <div class="preview bg-secondary">
            <h2 class="text-center"><i class="uil uil-clock-five"></i></h2>
          </div>

          <div class="info">
            <h6>PENDING ORDERS</h6>
            <h2><b><?php echo $pending_fetch['total'] ?></b></h2>
            <a href="order-pending.php" class="text-info">MORE INFO </a>
          </div>
        </div>
        <br>
      </div>

      <?php
        if ($emp_position != '') {
          $process = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_my_reseller = '$myid' AND trans_status = 'On Process'";
          $process_sql = mysqli_query($connect, $process);
          $process_fetch = mysqli_fetch_array($process_sql);
        } else {
          $process = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_seller = '$myid' AND trans_status = 'On Process'";
          $process_sql = mysqli_query($connect, $process);
          $process_fetch = mysqli_fetch_array($process_sql);
        }
      ?>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="course">
          <div class="preview bg-info">
            <h2 class="text-center"><i class="uil uil-process"></i></h2>
          </div>

          <div class="info">
            <h6>ON PROCESS ORDERS</h6>
            <h2><b><?php echo $process_fetch['total'] ?></b></h2>
            <a href="order-on-process.php" class="text-info">MORE INFO </a>
          </div>
        </div>
        <br>
      </div>

      <?php
        if ($emp_position != '') {
          $transit = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_my_reseller = '$myid' AND trans_status = 'In Transit'";
          $transit_sql = mysqli_query($connect, $transit);
          $transit_fetch = mysqli_fetch_array($transit_sql);
        } else {
          $transit = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_seller = '$myid' AND trans_status = 'In Transit'";
          $transit_sql = mysqli_query($connect, $transit);
          $transit_fetch = mysqli_fetch_array($transit_sql);
        }
      ?>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="course">
          <div class="preview bg-primary">
            <h2 class="text-center"><i class="uil uil-truck"></i></h2>
          </div>

          <div class="info">
            <h6>IN TRANSIT ORDERS</h6>
            <h2><b><?php echo $transit_fetch['total'] ?></b></h2>
            <a href="order-on-transit.php" class="text-info">MORE INFO </a>
          </div>
        </div>
        <br>
      </div>

      <?php
        if ($emp_position != '') {
          $delivered = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_my_reseller = '$myid' AND trans_status = 'Delivered'";
          $delivered_sql = mysqli_query($connect, $delivered);
          $delivered_fetch = mysqli_fetch_array($delivered_sql);
        } else {
          $delivered = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_seller = '$myid' AND trans_status = 'Delivered'";
          $delivered_sql = mysqli_query($connect, $delivered);
          $delivered_fetch = mysqli_fetch_array($delivered_sql);
        }
      ?>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="course">
          <div class="preview bg-success">
            <h2 class="text-center"><i class="uil uil-check-circle"></i></h2>
          </div>

          <div class="info">
            <h6>DELIVERED ORDERS</h6>
            <h2><b><?php echo $delivered_fetch['total'] ?></b></h2>
            <a href="order-delivered.php" class="text-info">MORE INFO </a>
          </div>
        </div>
        <br>
      </div>

      <?php
        if ($emp_position != '') {
          $canceled = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_my_reseller = '$myid' AND trans_status = 'Canceled'";
          $canceled_sql = mysqli_query($connect, $canceled);
          $canceled_fetch = mysqli_fetch_array($canceled_sql);
        } else {
          $canceled = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_seller = '$myid' AND trans_status = 'Canceled'";
          $canceled_sql = mysqli_query($connect, $canceled);
          $canceled_fetch = mysqli_fetch_array($canceled_sql);
        }
      ?>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="course">
          <div class="preview bg-danger">
            <h2 class="text-center"><i class="uil uil-times-circle"></i></h2>
          </div>

          <div class="info">
            <h6>CANCELED ORDERS</h6>
            <h2><b><?php echo $canceled_fetch['total'] ?></b></h2>
            <a href="order-cancel.php" class="text-info">MORE INFO </a>
          </div>
        </div>
        <br>
      </div>

      <?php
        if ($emp_position != '') {
          $rts = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_my_reseller = '$myid' AND trans_status = 'RTS'";
          $rts_sql = mysqli_query($connect, $rts);
          $rts_fetch = mysqli_fetch_array($rts_sql);
        } else {
          $rts = "SELECT COUNT(trans_poid) AS total FROM upti_transaction WHERE trans_seller = '$myid' AND trans_status = 'RTS'";
          $rts_sql = mysqli_query($connect, $rts);
          $rts_fetch = mysqli_fetch_array($rts_sql);
        }
      ?>
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="course">
          <div class="preview bg-danger">
            <h2 class="text-center"><i class="uil uil-corner-up-left-alt"></i></h2>
          </div>

          <div class="info">
            <h6>RTS ORDERS</h6>
            <h2><b><?php echo $rts_fetch['total'] ?></b></h2>
            <a href="order-rts.php" class="text-info">MORE INFO </a>
          </div>
        </div>
        <br>
      </div>

    </div>
    <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
<?php include 'include/footer.php'; ?>