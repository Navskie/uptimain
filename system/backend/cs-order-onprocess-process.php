<?php
    include '../dbms/conn.php';

    session_start();
    $uid = $_SESSION['uid'];

    $id = $_GET['id'];
    
    $get_poid = "SELECT * FROM web_transaction WHERE id = '$id'";
    $get_poid_qry = mysqli_query($connect, $get_poid);
    $get_poid_fetch = mysqli_fetch_array($get_poid_qry);
    
    $poid = $get_poid_fetch['trans_ref'];
    $customer_country = $get_poid_fetch['trans_country'];
    $mode_of_payment = $get_poid_fetch['trans_mop'];
    
    $getnamex = "SELECT * FROM upti_users WHERE users_id = '$uid'";
    $getnamex_qry = mysqli_query($connect, $getnamex);
    $getnamex_fetch = mysqli_fetch_array($getnamex_qry);
    
    $namex = $getnamex_fetch['users_name'];

    if (isset($_POST['onprocess'])) {
        // $track = $_POST['tracking'];
        
        date_default_timezone_set('Asia/Manila');
        $time = date("h:m:i");
        $datenow = date('m-d-Y');
        
        $desc = $namex.' Update '.$poid.' set Ordered Status into On Process'; 

        // HISTORY
        $act = "INSERT INTO upti_activities (activities_poid, activities_time, activities_date, activities_name, activities_caption, activities_desc) VALUES ('$poid', '$time', '$datenow', '$namex', 'On Process', '$desc')";
        $act_qry = mysqli_query($connect, $act);
        
        // INVENTORY REPORT
        $inv_report = "UPDATE stockist_report SET rp_status = 'On Process' WHERE rp_poid = '$poid'";
        $inv_report_qry = mysqli_query($connect, $inv_report);
        
        // INVENTORY HISTORY
        $inv_history = "UPDATE stockist_history SET history_status = 'On Process' WHERE history_poid = '$poid'";
        $inv_history_qry = mysqli_query($connect, $inv_history);

        $epayment_process = "UPDATE web_transaction SET trans_status = 'On Process' WHERE id = '$id'";
        $epayment_process_qry = mysqli_query($connect, $epayment_process);

        $epayment_process1 = "UPDATE web_cart SET cart_status = 'On Process' WHERE cart_ref = '$poid'";
        $epayment_process_qry1 = mysqli_query($connect, $epayment_process1);

        $remarks_sql = "INSERT INTO upti_remarks (remark_poid, remark_content, remark_name, remark_reseller) VALUES ('$poid', 'Your Order is being Processed', '$namex', 'Unread')";
        $remarks_qry = mysqli_query($connect, $remarks_sql);

        // Inventory Check Qty
        $get_qty_code = "SELECT * FROM web_cart WHERE cart_ref = '$poid'";
        $get_qty_code_qry = mysqli_query($connect, $get_qty_code);
        while ($get_qty_code_fetch = mysqli_fetch_array($get_qty_code_qry)) {
            $code_code = $get_qty_code_fetch['cart_code'];
            $code_qty = $get_qty_code_fetch['cart_qty'];

            // CHECK MOD AND COUNTRY
            if ($mode_of_payment != 'Cash On Pick Up') {
                $check_package = "SELECT * FROM upti_package WHERE package_code = '$code_code'";
                $check_package_sql = mysqli_query($connect, $check_package);
                $check_package_num = mysqli_num_rows($check_package_sql);
                $check_package_fetch = mysqli_fetch_array($check_package_sql);
                // PACKAGE CHECK
                if ($check_package_num > 0) {
                    // 1
                    $c1 = $check_package_fetch['package_one_code'];
                    $oq1 = $check_package_fetch['package_one_qty'];
                    $q1 = $oq1 * $code_qty;

                    $inv_stock = "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c1'";
                    $inv_stock_qry = mysqli_query($connect, $inv_stock);
                    $inv_stock_fetch = mysqli_fetch_array($inv_stock_qry);

                    $total_stock = $inv_stock_fetch['si_item_stock'];

                    if ($total_stock != 0) {
                        $new_total_stock = $total_stock - $q1;

                        $update_inventory = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock' WHERE si_item_country = '$customer_country' AND si_item_code = '$c1'";
                        $update_inventory_qry = mysqli_query($connect, $update_inventory);
                    }

                    // 2
                    $c2 = $check_package_fetch['package_two_code'];
                    $oq2 = $check_package_fetch['package_two_qty'];
                    $q2 = $oq2 * $code_qty;

                    $inv_stock2 = "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c2'";
                    $inv_stock_qry2 = mysqli_query($connect, $inv_stock2);
                    $inv_stock_fetch2 = mysqli_fetch_array($inv_stock_qry2);

                    $total_stock2 = $inv_stock_fetch2['si_item_stock'];

                    if ($total_stock2 != 0) { 
                        $new_total_stock2 = $total_stock2 - $q2;

                        $update_inventory2 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock2' WHERE si_item_country = '$customer_country' AND si_item_code = '$c2'";
                        $update_inventory_qry2 = mysqli_query($connect, $update_inventory2);
                    }

                    // 3
                    $c3 = $check_package_fetch['package_three_code'];
                    $oq3 = $check_package_fetch['package_three_qty'];
                    $q3 = $oq3 * $code_qty;

                    $inv_stock3 = "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c3'";
                    $inv_stock_qry3 = mysqli_query($connect, $inv_stock3);
                    $inv_stock_fetch3 = mysqli_fetch_array($inv_stock_qry3);

                    $total_stock3 = $inv_stock_fetch3['si_item_stock'];

                    if ($total_stock3 != 0) {
                        $new_total_stock3 = $total_stock3 - $q3;

                        $update_inventory3 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock3' WHERE si_item_country = '$customer_country' AND si_item_code = '$c3'";
                        $update_inventory_qry3 = mysqli_query($connect, $update_inventory3);
                    }

                    // 4
                    $c4 = $check_package_fetch['package_four_code'];
                    $oq4 = $check_package_fetch['package_four_qty'];
                    $q4 = $oq4 * $code_qty;

                    $inv_stock4 = "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c4'";
                    $inv_stock_qry4 = mysqli_query($connect, $inv_stock4);
                    $inv_stock_fetch4 = mysqli_fetch_array($inv_stock_qry4);

                    $total_stock4 = $inv_stock_fetch4['si_item_stock'];

                    if ($total_stock4 != 0) {
                        $new_total_stock4 = $total_stock4 - $q4;

                        $update_inventory4 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock4' WHERE si_item_country = '$customer_country' AND si_item_code = '$c4'";
                        $update_inventory_qry4 = mysqli_query($connect, $update_inventory4);
                    }

                    // 5
                    $c5 = $check_package_fetch['package_five_code'];
                    $oq5 = $check_package_fetch['package_five_qty'];
                    $q5 = $oq5 * $code_qty;

                    $inv_stock5 = "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$c5'";
                    $inv_stock_qry5 = mysqli_query($connect, $inv_stock5);
                    $inv_stock_fetch5 = mysqli_fetch_array($inv_stock_qry5);

                    $total_stock5 = $inv_stock_fetch5['si_item_stock'];

                    if($total_stock5 != 0) {
                        $new_total_stock5 = $total_stock5 - $q5;

                        $update_inventory5 = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock5' WHERE si_item_country = '$customer_country' AND si_item_code = '$c5'";
                        $update_inventory_qry5 = mysqli_query($connect, $update_inventory5);
                    }
                }
                // PACKAGE CHECK
                else
                // SINGLE CHECK
                {
                    $get_new_code = "SELECT * FROM upti_code WHERE code_name = '$code_code'";
                    $get_new_code_qry = mysqli_query($connect, $get_new_code);
                    $get_new_code_fetch = mysqli_fetch_array($get_new_code_qry);

                    $code_codes = $get_new_code_fetch['code_main'];

                    $inv_stock = "SELECT * FROM stockist_inventory WHERE si_item_country = '$customer_country' AND si_item_code = '$code_codes'";
                    $inv_stock_qry = mysqli_query($connect, $inv_stock);
                    $inv_stock_fetch = mysqli_fetch_array($inv_stock_qry);

                    $total_stock = $inv_stock_fetch['si_item_stock'];

                    $new_total_stock = $total_stock - $code_qty;

                    $update_inventory = "UPDATE stockist_inventory SET si_item_stock = '$new_total_stock' WHERE si_item_country = '$customer_country' AND si_item_code = '$code_codes'";
                    $update_inventory_qry = mysqli_query($connect, $update_inventory);
                }
                // SINGLE CHECK

                // INVENTORY HISTORY
                $inv_history = "INSERT INTO stockist_history (history_date, history_poid, history_status) VALUES ('$datenow', '$poid', 'Pending')";
                $inv_history_qry = mysqli_query($connect, $inv_history);
            }
            // CHECK MOD AND COUNTRY
        }
        // Inventory Check Qty
        
        // $remarks_sql2 = "INSERT INTO upti_remarks (remark_poid, remark_content, remark_name, remark_reseller) VALUES ('$poid', 'TRACKING NUMBER: $track', '$namex', 'Unread')";
        // $remarks_qry2 = mysqli_query($connect, $remarks_sql2);


    ?>
        <script>alert('Order Status has been changed to On Process Successfully');window.location.href = '../poid-list2.php?id=<?php echo $id ?>';</script>
    <?php
        }
    ?>