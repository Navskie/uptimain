<?php
    session_start();
    include 'dbms/conn.php';
             
        // Column Name
        $output = '
            <table class="table" border="1">
            <tr>
                <th>Date</th>
                <th>Poid</th>
                <th>Percentage</th> 
                <th>Remarks</th> 
                <th>Status</th> 
            <tr> 
        ';

        $export_sql = "SELECT * FROM stockist_percentage INNER JOIN upti_transaction ON trans_poid = p_poid WHERE p_code = 'S1123' AND trans_country = 'CANADA' AND trans_state = 'ALBERTA'";
        
        // echo '<br>';
        $export_qry = mysqli_query($connect, $export_sql);
        $export_num = mysqli_num_rows($export_qry);

        if($export_num > 0) {
            while($row = mysqli_fetch_array($export_qry)) {
                $output .='
                    <tr>
                        <td>'.$row['p_date'].' - '.$row['p_time'].'</td>
                        <td>'.$row['p_poid'].'</td>
                        <td>'.$row['p_amount'].'</td>
                        <td>'.$row['p_desc'].'</td>
                        <td>'.$row['p_pack'].'</td>
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