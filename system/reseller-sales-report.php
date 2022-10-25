<?php
    session_start();
    include 'dbms/conn.php';

    $uid = $_SESSION['code'];

    $reseller_ = mysqli_query($connect, "SELECT * FROM stockist WHERE stockist_code = '$uid'");
    $reseller__ = mysqli_fetch_array($reseller_);

    $country = $reseller__['stockist_country'];
    $state = $reseller__['stockist_state'];

    if (isset($_POST['export'])) {
        $newDate1 = $_POST['date1'];
        $date1 = date("m-d-Y", strtotime($newDate1));
        $newDate2 = $_POST['date2'];
        $date2 = date("m-d-Y", strtotime($newDate2));
             
        // Column Name
        $output = '
            <table class="table" border="1">
            <tr>
                <th>Mobile Number</th> 
                <th>Item Code</th>
                <th>Quantity</th>
                <th>Price</th> 
            <tr> 
        ';

        if($export_num > 0) {
            while($row = mysqli_fetch_array($export_qry)) {
                $seller = $row['ol_seller'];
                        
                $get_seller = "SELECT users_name FROM upti_users WHERE users_code = '$seller'";
                $get_seller_qry = mysqli_query($connect, $get_seller);
                $get_seller_fetch = mysqli_fetch_array($get_seller_qry);
                $output .='
                    <tr>
                        <td>'.$row['trans_contact'].'</td>
                        <td>'.$row['ol_code'].'</td>
                        <td>'.$row['ol_qty'].'</td>
                        <td>'.$row['ol_price'].'</td>
                    </tr>
                ';
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=reseller_sales_report".$date1.'-'.$date2.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            // }
            // Render excel data file
            echo $output;
            // ob_end_flush();
            exit;
        }
    }   
                    
?>