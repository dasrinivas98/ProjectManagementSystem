<?php
    include('dbconnect.php');
   
   if (isset($_GET['gid'])) {
        $id = $_GET['gid'];
        $fs =$_GET['finalStatus'];
        if($fs==0){
            $fileName = "Pending_projects".date('Ymd').".csv";
        }
        else{
            $fileName = "Completed_projects".date('Ymd').".csv";
        }
        // function filterData(&$str){ 
        //     $str = preg_replace("/\t/", "\\t", $str); 
        //     $str = preg_replace("/\r?\n/", "\\n", $str); 
        //     if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
        // } 
 
        // // Column names 
        // $fields = array('SR.N.', 'NAME', 'USN', 'Project TItle'); 
         
        // // Display column names as first row 
        // $excelData = implode("\t", array_values($fields)) . "\n"; 
         
        // // Get records from the database 
        // $query = $link->query("select * from projects INNER JOIN students on projects.s_id = students.s_id where g_id = $id and finalStatus=$fs"); 
        // if($query->num_rows > 0){ 
        //     // Output each row of the data 
        //     $i=0; 
        //     while($row = $query->fetch_assoc()){ $i++; 
        //         $rowData = array($i, $row['s_name'], $row['s_usn'], $row['p_title']); 
        //         array_walk($rowData, 'filterData'); 
        //         $excelData .= implode("\t", array_values($rowData)) . "\n"; 
        //     } 
        // }else{ 
        //     $excelData .= 'No records found...'. "\n"; 
             
        // } 
         
        // // Headers for download 
        // ob_clean();
        // header("Content-Disposition: attachment; filename=\"$fileName\""); 
        // header("Content-Type: text/csv"); 
         
        // // Render excel data 
        // echo $excelData; 
         
        // exit;
//         $sql = "select s_name as Name,s_usn as USN,p_title as 'Project Title' from projects INNER JOIN students on projects.s_id = students.s_id where g_id = $id and finalStatus=$fs";  
//         // $filename = "excelfilename";  //your_file_name
//         // $file_ending = "xls";   //file_extention
//             ob_end_clean();
//             header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//             header("Content-Type: application/download");    
//             header("Content-Disposition: attachment; filename=\"$fileName\"");  
//             header("Pragma: no-cache"); 
//             header("Expires: 0");

//             $sep = ",";

//             $resultt = $link->query($sql);
//             while ($property = mysqli_fetch_field($resultt)) { //fetch table field name
//                 echo $property->name."\t";
//             }

//             print("\n");    

//             while($row = mysqli_fetch_row($resultt))  //fetch_table_data
//             {
//                 $schema_insert = "";
//                 for($j=0; $j< mysqli_num_fields($resultt);$j++)
//                 {
//                     if(!isset($row[$j]))
//                         $schema_insert .= "NULL".$sep;
//                     elseif ($row[$j] != "")
//                         $schema_insert .= "$row[$j]".$sep;
//                     else
//                         $schema_insert .= "".$sep;
//                 }
//                 $schema_insert = str_replace($sep."$", "", $schema_insert);
//                 $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
//                 $schema_insert .= ",";
//                 print(trim($schema_insert));
//                 print "\n";
// }
$sql = "select s_name as Name,s_usn as USN,p_title as 'Project Title' from projects INNER JOIN students on projects.s_id = students.s_id where g_id = $id and finalStatus=$fs";
if (!$result = mysqli_query($link, $sql)) {
    exit(mysqli_error($link));
}

$users = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}
ob_end_clean();
header('Content-Type: text/csv; charset=utf-8');
header("Content-Disposition: attachment; filename=\"$fileName\"");
$output = fopen('php://output', 'w');
fputcsv($output, array('Name', 'USN', 'Title'));

if (count($users) > 0) {
    foreach ($users as $row) {
        fputcsv($output, $row);
    }
}
        }

?>