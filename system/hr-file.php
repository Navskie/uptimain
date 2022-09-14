<?php
    include 'dbms/conn.php';

    session_start();

    // Reseller OSR sales and points
    if (isset($_POST['export'])) {

        $newDate1 = $_POST['date1'];
        $date1 = date("m-d-Y", strtotime($newDate1));
        $newDate2 = $_POST['date2'];
        $date2 = date("m-d-Y", strtotime($newDate2));
        $status = $_POST['status'];
        $bansa = $_POST['bansa'];

        // Column Name
        $output = '
        <table class="table" bordered="1">
        <tr>
            <th>OSR</th>
            <th>POID</th>
            <th>COUNTRY</th>
            <th>DATE</th>
            <th>CUSTOMER NAME</th>
            <th>AMOUNT</th>
            <th>STATUS</th>
        <tr>
        ';

        if ($bansa == '' && $status == '') {
            // Fetch Records From Database
            $export_sql = "SELECT users_name, users_code FROM upti_users WHERE users_role ='UPTIOSR'";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            while($row = mysqli_fetch_array($export_qry)) {    
                $code = $row['users_code'];
                
                $get_trans = mysqli_query($connect, "SELECT trans_subtotal, trans_poid, trans_country, trans_date, trans_fname, trans_status FROM upti_transaction WHERE trans_seller = '$code' AND trans_date BETWEEN '$date1' AND '$date2'");

                while ($sales = mysqli_fetch_array($get_trans)) {
                    $output .='
                    <tr>
                        <td>'.$row['users_name'].'</td>
                        <td>'.$sales['trans_poid'].'</td>
                        <td>'.$sales['trans_country'].'</td>
                        <td>'.$sales['trans_date'].'</td>
                        <td>'.$sales['trans_fname'].'</td>
                        <td>'.$sales['trans_subtotal'].'</td>
                        <td>'.$sales['trans_status'].'</td>
                    </tr>
                    ';
                }
                
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=OSR_sales".$date1.'-'.$date2.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            // }
            // Render excel data file
            echo $output;
            // ob_end_flush();
            exit;
        } elseif ($bansa != '' AND $status = '') {
            // Fetch Records From Database
            $export_sql = "SELECT users_name, users_code FROM upti_users WHERE users_role ='UPTIOSR'";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            while($row = mysqli_fetch_array($export_qry)) {    
                $code = $row['users_code'];
                
                $get_trans = mysqli_query($connect, "SELECT trans_subtotal, trans_poid, trans_country, trans_date, trans_fname, trans_status FROM upti_transaction WHERE trans_country = '$bansa' trans_seller = '$code' AND trans_date BETWEEN '$date1' AND '$date2'");

                while ($sales = mysqli_fetch_array($get_trans)) {
                    $output .='
                    <tr>
                        <td>'.$row['users_name'].'</td>
                        <td>'.$sales['trans_poid'].'</td>
                        <td>'.$sales['trans_country'].'</td>
                        <td>'.$sales['trans_date'].'</td>
                        <td>'.$sales['trans_fname'].'</td>
                        <td>'.$sales['trans_subtotal'].'</td>
                        <td>'.$sales['trans_status'].'</td>
                    </tr>
                    ';

                }
                
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=OSR_sales".$date1.'-'.$date2.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            // }
            // Render excel data file
            echo $output;
            // ob_end_flush();
            exit;
        } elseif ($bansa == '' AND $status != '') {
            // Fetch Records From Database
            $export_sql = "SELECT users_name, users_code FROM upti_users WHERE users_role ='UPTIOSR'";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            while($row = mysqli_fetch_array($export_qry)) {    
                $code = $row['users_code'];
                
                $get_trans = mysqli_query($connect, "SELECT trans_subtotal, trans_poid, trans_country, trans_date, trans_fname, trans_status FROM upti_transaction WHERE trans_status = '$status' AND trans_seller = '$code' AND trans_date BETWEEN '$date1' AND '$date2'");

                while ($sales = mysqli_fetch_array($get_trans)) {
                    $output .='
                    <tr>
                        <td>'.$row['users_name'].'</td>
                        <td>'.$sales['trans_poid'].'</td>
                        <td>'.$sales['trans_country'].'</td>
                        <td>'.$sales['trans_date'].'</td>
                        <td>'.$sales['trans_fname'].'</td>
                        <td>'.$sales['trans_subtotal'].'</td>
                        <td>'.$sales['trans_status'].'</td>
                    </tr>
                    ';

                }
                
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=OSR_sales".$date1.'-'.$date2.".xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            // }
            // Render excel data file
            echo $output;
            // ob_end_flush();
            exit;
        } elseif ($bansa != '' AND $status != '') {
            // Fetch Records From Database
            $export_sql = "SELECT users_name, users_code FROM upti_users WHERE users_role ='UPTIOSR'";
            // echo '<br>';
            $export_qry = mysqli_query($connect, $export_sql);
            while($row = mysqli_fetch_array($export_qry)) {    
                $code = $row['users_code'];
                
                $get_trans = mysqli_query($connect, "SELECT trans_subtotal, trans_poid, trans_country, trans_date, trans_fname, trans_status FROM upti_transaction WHERE trans_country = '$bansa' AND trans_status = '$status' AND trans_seller = '$code' AND trans_date BETWEEN '$date1' AND '$date2'");

                while ($sales = mysqli_fetch_array($get_trans)) {
                    $output .='
                    <tr>
                        <td>'.$row['users_name'].'</td>
                        <td>'.$sales['trans_poid'].'</td>
                        <td>'.$sales['trans_country'].'</td>
                        <td>'.$sales['trans_date'].'</td>
                        <td>'.$sales['trans_fname'].'</td>
                        <td>'.$sales['trans_subtotal'].'</td>
                        <td>'.$sales['trans_status'].'</td>
                    </tr>
                    ';

                }
                
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=OSR_sales".$date1.'-'.$date2.".xls");
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