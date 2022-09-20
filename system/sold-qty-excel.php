<?php
  include 'dbms/conn.php';

  // $path = 'Code_Quantity_Report.xlsx';
  session_start();

  require 'vendor/autoload.php';

  use PhpOffice\PhpSpreadsheet\Spreadsheet;
  use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

  if (isset($_POST['SQR'])) {
    $newDate1 = $_POST['date1'];
    $date1 = date("m-d-Y", strtotime($newDate1));
    $newDate2 = $_POST['date2'];
    $date2 = date("m-d-Y", strtotime($newDate2));
    $country = $_POST['country'];
    $status = $_POST['status'];

    $code_stmt = mysqli_query($connect, "SELECT ol_price, ol_date, activities_date, users_name, ol_poid, ol_country, ol_desc, ol_qty, ol_status, activities_caption FROM upti_order_list INNER JOIN upti_users ON ol_seller = users_code INNER JOIN upti_activities ON ol_poid = activities_poid WHERE ol_date BETWEEN '$date1' AND '$date2'");
    if (mysqli_num_rows($code_stmt))
    {
      $fileName = 'Sold_Quantity_Report';
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      // Column Name List
      $sheet->setCellValue('A1', 'DATE ORDER');
      $sheet->setCellValue('B1', 'DATE TRIGGERED');
      $sheet->setCellValue('C1', 'SELLER NAME');
      $sheet->setCellValue('D1', 'POID');
      $sheet->setCellValue('E1', 'COUNTRY');
      $sheet->setCellValue('F1', 'DESCRIPTION');
      $sheet->setCellValue('G1', 'QTY');
      $sheet->setCellValue('H1', 'PRICE');
      $sheet->setCellValue('I1', 'STATUS');

      $rowCount = 2;
      // data loop
      foreach ($code_stmt as $data) {
        $status_remark = $data['activities_caption'];
        if ($status_remark === 'Order Delivered') {
          $status_remark = 'Delivered';
        }

        $sheet->setCellValue('A'.$rowCount, $data['ol_date']);
        $sheet->setCellValue('B'.$rowCount, $data['activities_date']);
        $sheet->setCellValue('C'.$rowCount, $data['users_name']);
        $sheet->setCellValue('D'.$rowCount, $data['ol_poid']);
        $sheet->setCellValue('E'.$rowCount, $data['ol_country']);
        $sheet->setCellValue('F'.$rowCount, $data['ol_desc']);
        $sheet->setCellValue('G'.$rowCount, $data['ol_qty']);
        $sheet->setCellValue('H'.$rowCount, $data['ol_price']);
        $sheet->setCellValue('I'.$rowCount, $status_remark);
        $rowCount++;
      }

      $writer = new Xlsx($spreadsheet);
      $new_FileName = $fileName.'.xlsx';

      // $writer->save($new_FileName);

      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="'.urlencode($new_FileName).'"');
      $writer->save('php://output');
    }
    else
    {
      echo 'no record found.';
    }
  }
?>