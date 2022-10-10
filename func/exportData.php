<?php 
 
    // Load the database configuration file 
    require_once "/Users/erwinkujawski/Desktop/Inv/database/config.php";
 
    $query = mysqli_query($con, "SELECT * FROM items ORDER BY id ASC"); 
    
    if($query->num_rows > 0) { 
        $delimiter = ","; 
        $filename = "items-data_" . date('Y-m-d') . ".csv"; 
        
        // Create a file pointer 
        $f = fopen('php://memory', 'w'); 
        
        // Set column headers 
        $fields = array('Id', 'item', 'count', 'Serial Number', 'Description', 'Added On'); 
        fputcsv($f, $fields, $delimiter); 
        
        // Output each row of the data, format line as csv and write to file pointer 
        while($row = $query->fetch_assoc()) { 

            $status = ($row['status'] == 1)?'Active':'Inactive'; 
            $lineData = array($row['id'], $row['item'], $row['count'], $row['s_n'], $row['desc'], $row['added_at']);

            fputcsv($f, $lineData, $delimiter); 
        } 
        
        // Move back to beginning of file 
        fseek($f, 0); 
        
        // Set headers to download file rather than displayed 
        header('Content-Type: text/csv'); 
        header('Content-Disposition: attachment; filename="' . $filename . '";'); 
        
        //output all remaining data on a file pointer 
        fpassthru($f); 
    }
    exit;
 
?>