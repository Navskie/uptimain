<?php
    session_start();
    include 'dbms/conn.php';
             
        // Column Name
        $output = '
            <table class="table" border="1">
            <tr>
                <th>Poid</th>
                <th>Item Code</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Peso</th>
                <th>Date</th> 
            <tr> 
        ';

        $export_sql = "SELECT * FROM upti_order_list INNER JOIN upti_activities ON ol_poid = activities_poid WHERE ol_reseller = 'RS115' AND activities_caption = 'Order Delivered' AND activities_date BETWEEN '10-01-2022' AND '10-31-2022'";
        
        // echo '<br>';
        $export_qry = mysqli_query($connect, $export_sql);
        $export_num = mysqli_num_rows($export_qry);

        if($export_num > 0) {
            while($row = mysqli_fetch_array($export_qry)) {
                $output .='
                    <tr>
                        <td>'.$row['ol_poid'].'</td>
                        <td>'.$row['ol_code'].'</td>
                        <td>'.$row['ol_desc'].'</td>
                        <td>'.$row['ol_qty'].'</td>
                        <td>'.$row['ol_php'].'</td>
                        <td>'.$row['activities_date'].'</td>
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