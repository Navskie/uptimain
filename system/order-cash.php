<?php include 'include/header.php'; ?>
<?php if ($_SESSION['role'] == 'UPTIMAIN' || $_SESSION['role'] == 'UPTIMAINS') { ?>
<?php include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="background: #f8f8f8 !important">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card rounded-0">
                <div class="card-body login-card-body text-dark">
                    <div class="row">
                        <div class="col-12">
                        <span class="float-left text-primary"><b>Pick Up Location</b></span>

                        <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" data-toggle="modal" data-target="#add">
                          Add Shipping Fee
                        </button>
                        </div>
                        
                        <div class="col-12">
                            <hr>
                        </div>
                        <div class="col-12">
                            <!-- Order List Table Start -->
                            <table id="example1" class="table table-md table-striped table-hover border border-info">
                                <thead>
                                  <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">Location</th>
                                    <th class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <?php
                                  $epayment_sql = "SELECT * FROM upti_mod WHERE mod_status = 'cash'";
                                  $epayment_qry = mysqli_query($connect, $epayment_sql);
                                  $number = 1;
                                  while ($epayment = mysqli_fetch_array($epayment_qry)) {
                                ?>
                                <tr>
                                  <td class="text-center"><?php echo $number; ?></td>
                                  <td class="text-center"><?php echo $epayment['mod_country'] ?></td>
                                  <td class="text-center"><img src="images/payment/<?php echo $epayment['mod_img'] ?>" width="50"></td>
                                  <td class="text-center">
                                    <button class="btn btn-warning btn-sm rounded-0" data-toggle="modal" data-target="#edit<?php echo $epayment['id']; ?>">Update</button>
                                    <button class="btn btn-danger btn-sm rounded-0" data-toggle="modal" data-target="#delete<?php echo $epayment['id']; ?>">Delete</button>
                                  </td>
                                </tr>
                                <?php
                                  include 'backend/cash-edit-modal.php';
                                  include 'backend/cash-delete-modal.php';
                                  $number++;
                                  }
                                ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
  <?php include 'backend/cash-add-modal.php'; ?>

<?php include 'include/footer.php'; ?>

<?php } else { echo "<script>window.location='../login.php'</script>"; } ?>