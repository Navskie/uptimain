<?php include 'include/header.php'; ?>
<?php //include 'include/preloader.php'; ?>
<?php include 'include/navbar.php'; ?>
<?php include 'include/sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1 class="m-0">Account List</h1> -->
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li> 
              <li class="breadcrumb-item active">OSR Reports</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid --> 
    </div>
    <!-- /.content-header -->
    
    <!-- START HERE -->
    <section class="content">
        <div class="container-fluid">
            <!-- Generate Sales -->
            
            <div class="card">
                <div class="card-header">
                Generate OSR Sales Ranking
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="row">
                                <!-- First Row -->
                                <div class="col-12">
                                    <br>
                                    <img src="images/icon/excel.png" alt="" class="image-fluid">
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <form action="excel-file.php" method="post">
                                <div class="row">
                                    <!-- 1st Row -->
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Date From</label>
                                            <input type="date" name="date1" class="form-control" min="1997-01-01" max="2300-12-31">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Date To</label>
                                            <input type="date" name="date2" class="form-control" min="1997-01-01" max="2300-12-31">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="">Order Status</label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="status">
                                                <option value="">Select Status</option>
                                                <option value="Order Delivered">Delivered</option>
                                                <option value="RTS">RTS</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for=""><i class="fas fa-excel"></i></label><br>
                                            <button class="btn btn-dark form-control" name="osr_sales_report">Export</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
  </div>

<?php include 'include/footer.php'; ?>