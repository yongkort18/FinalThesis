<?php 
// Load the database configuration file 
include_once '../connect.php'; 
 
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
$fileName = "Sales_Report_" . date('Y-m-d') . ".xls"; 
 
// Column names 
$fields = array('EMAIL', 'NAME', 'FEE', 'AMOUNT', 'DATE','STATUS'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$query = $con->query("SELECT tbl_fee.*, tbl_reservation.user_name,tbl_reservation.status,tbl_reservation.email
FROM tbl_fee
JOIN tbl_reservation ON tbl_fee.reservation_id = tbl_reservation.id  ORDER BY id ASC;"); 
if($query->num_rows > 0){ 
    // Output each row of the data 
    while($row = $query->fetch_assoc()){ 
        $status = ($row['status'] == 1)?'PAID':'NOT PAID'; 
        $lineData = array($row['email'], $row['user_name'], $row['fee'],  $row['amount'], $row['dateAt'],  $status); 
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit;