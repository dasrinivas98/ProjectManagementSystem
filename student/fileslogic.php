<!-- <?php
 include('../assests/dbconnect.php');

if (isset($_GET['pid'])) {
    $id = $_GET['pid'];


    $sql = "SELECT * FROM projects WHERE p_id=$id";
    $result = mysqli_query($link, $sql);
    $file = mysqli_fetch_assoc($result);
    
    $filepath = 'uploads/' . $file['report'];
    echo "<script>console.log('".$filepath."')</script>";
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . basename($filepath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize('uploads/' . $file['name']));
        readfile('uploads/' . $file['name']);
        exit;
    }
    else{
        echo"dont";
    }

}?> -->