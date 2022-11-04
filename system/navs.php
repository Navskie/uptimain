<?php
    session_start();
    include 'dbms/conn.php';
             
        // Column Name
        $output = '
            <table class="table" border="1">
            <tr>
                <th>Stockist ID</th>
                <th>Poid</th>
                <th>Item Code</th> 
                <th>Description</th> 
                <th>Country</th> 
                <th>Qty</th>
                <th>Price</th> 
                <th>Subtotal</th> 
                <th>Refund</th> 
            <tr> 
        ';

        $export_sql = "SELECT * FROM stockist_earning INNER JOIN upti_transaction ON trans_poid = e_poid WHERE e_id = 'S1123' AND trans_country = 'CANADA' AND trans_state = 'ALBERTA'";
        
        // echo '<br>';
        $export_qry = mysqli_query($connect, $export_sql);
        $export_num = mysqli_num_rows($export_qry);

        if($export_num > 0) {
            while($row = mysqli_fetch_array($export_qry)) {
                $output .='
                    <tr>
                        <td>'.$row['e_id'].'</td>
                        <td>'.$row['e_poid'].'</td>
                        <td>'.$row['e_code'].'</td>
                        <td>'.$row['e_desc'].'</td>
                        <td>'.$row['e_country'].'</td>
                        <td>'.$row['e_qty'].'</td>
                        <td>'.$row['e_price'].'</td>
                        <td>'.$row['e_subtotal'].'</td>
                        <td>'.$row['e_refund'].'</td>
                    </tr>
                ';
            }
            $output .= '</table>';
            // Header for  Download
            // if (! headers_sent()) {
            header("Content-Type: application/xls");
            header("Content-Disposition: attachment; filename=Percentage.xls");
            header("Pragma: no-cache");
            header("Expires: 0");
            // }
            // Render excel data file
            echo $output;
            // ob_end_flush();
            exit;
        }
    
                    
?>