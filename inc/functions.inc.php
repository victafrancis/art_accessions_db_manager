<?php
//functions by Francis Victa - 101159185

//defining the file name as main file storage
define("FILE_NAME","accession_register_for_works_of_art.csv");

//function to search the file for a term
function search($searchTerm){
    $line = file(FILE_NAME);
    $lineCount = count($line);
    $resultArr = [1]; //to add initial headers for temp search table
    //iterate through the lines array to check if search term is part of an array
    for($i=2; $i<$lineCount; $i++){
        if(strpos(strtolower($line[$i]),strtolower($searchTerm))){
            array_push($resultArr,$i);
        }
    }
    
    //transfer results to a temp csv file
    $handleOrig = fopen(FILE_NAME,"r");
    $handleCopy = fopen("temp_search_results.csv","w");
    $title = fgetcsv($handleOrig);
    fputcsv($handleCopy,$title); //adds title to temp file
    
    //loop to copy from original file to temp file if it matches search result
    for($i=1; $i<$lineCount; $i++){ 
        $data = fgetcsv($handleOrig);
        if(in_array($i,$resultArr)){
            fputcsv($handleCopy,$data);
        }
    }
    fclose($handleOrig);
    fclose($handleCopy);
    makeTable('temp_search_results.csv'); //call the local makeTable function to display the search results
}

//function to delete a record. Basically copies to another file excluding the record to delete
function deleteRecord($filename){
    //create two handles for the original file and the copy
    $handleOrig = fopen($filename,"r+") or die("Error reading the file!");
    $handleCopy = fopen("temp_copy.csv","w");
    $id = get('id');
    
    //while loop that copies, but skips the record to delete
    while(($data = fgetcsv($handleOrig))){
        if($id==$data[0]) continue;
        fputcsv($handleCopy,$data);
    }
    fclose($handleCopy);
    fclose($handleOrig);
    unlink($filename);
    rename('temp_copy.csv',$filename);
}

//function to edit the record
function editRecord($filename){
    //create two handles for the original file and the copy
    $handleOrig = fopen($filename,"r+") or die("Error reading the file!");
    $handleCopy = fopen("temp_copy.csv","w");
    $id = get('id');
    $editedData = [$id,get('date'),get('type'),get('artist'),get('title'),get('accession')]; //contains edited data
    
    //while loop copies all records from original. When it matches the id of the edited, it copies over the $editedData rather than original
    while(($data = fgetcsv($handleOrig))){
        if($id==$data[0]){
            fputcsv($handleCopy,$editedData);
        } else {
            fputcsv($handleCopy,$data);
        }
    }
    fclose($handleCopy);
    fclose($handleOrig);
    unlink($filename);
    rename('temp_copy.csv',$filename);
    phpAlert("Record has been edited!");
}

//function to add a new record
function addRecord($filename){
    $handle = fopen($filename,'a') or die("Error reading the file!");
    $id = findNextId($filename); //get unique id
    
    //adding the new record
    $data = [$id,get('date'),get('type'),get('artist'),get('title'),get('accession')];
    fputcsv($handle,$data);
    fclose($handle);
    phpAlert("Successfully added new record!");
}

//function to find the next unique ID in a file
function findNextId($filename){ 
    $handle = fopen($filename,'r+') or die("Error reading the file!");
    $idArr = array();

    //to grab array of ID numbers
    while(($data = fgetcsv($handle))){
        array_push($idArr,(int)$data[0]);
    }
    fclose($handle);
    return max($idArr) + 1;
}

//function to get set values sent over server
function get($item){
    return isset($_REQUEST[$item]) ? $_REQUEST[$item] : "";
}

//function to create a table from a file
function makeTable($filename){
    $output = '<table id="mainTable" class="table">';
    if (($handle = fopen($filename, "r")) !== FALSE) {
        //table header
        $title = fgetcsv($handle); //gets first row which is the title
        $data = fgetcsv($handle); //gets table headers
        $num = count($data); //counts number of columns
        $output.='<tr>';
        //headers below look like it can be put in a loop, however, I wanted each column width to be fixed by % to make it look better
        //1st column is 5%, 2nd is 10% and so on
        $output.='<th width=5%>'.$data[0].'</th>'; 
        $output.='<th width=10%>'.$data[1].'</th>'; 
        $output.='<th width=5%>'.$data[2].'</th>';
        $output.='<th width=25%>'.$data[3].'</th>';
        $output.='<th width=30%>'.$data[4].'</th>';
        $output.='<th width=15%>'.$data[5].'</th>';
        $output.='<th width=10%></th>';
        $output.='</tr>';

        //table contents
        while (($data = fgetcsv($handle))) {
            $output.='<tr scope="row">';
            for ($i=0; $i < $num; $i++) {
                $output .= '<td>'.$data[$i].'</td>';
            }
            //adding the edit and delete buttons. The href contains the details needed to be able to edit or delete a record
            $output.='<td><a href="edit_record.php?id='.$data[0].'&date='.$data[1].'&type='.$data[2].'&artist='.$data[3].'&title='.$data[4].'&accession='.$data[5].'" title="edit record"><i class="small material-icons">edit</i></href>
                        <a href="delete_record.php?id='.$data[0].'&date='.$data[1].'&type='.$data[2].'&artist='.$data[3].'&title='.$data[4].'&accession='.$data[5].'" title="delete record"><i class="small material-icons">delete</i></href></td></tr>';
        }
        fclose($handle);
    }
    echo "Entries found: " . (count(file($filename)) - 2); //displays the number of records found
    echo $output .= '</table>';
}

//function to export all data to a csv file
function exportData(){
    // output headers so that the file is downloaded
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=data.csv');

    //create output stream
    $output = fopen('php://output', 'w'); 
    $handle = fopen(FILE_NAME,'r');

    //loop through file where data is stored and copy to output file
    while($data = fgetcsv($handle)){ 
        fputcsv($output,$data);
    }
    fclose($output);
    fclose($handle);
}

//function to import new data from a csv file
function importData(){
    if(isset($_FILES['userfile']) && $_FILES["userfile"]["error"]==0){
        move_uploaded_file($_FILES["userfile"]["tmp_name"], $_FILES["userfile"]["name"]);
    } 

    //get the filename containing data to import, copy new data and add to current database    
    $newDataFile = $_FILES["userfile"]["name"];
    $handleData  = fopen($newDataFile,"r");
    $handleOrig = fopen(FILE_NAME,"a");
    //loop through new data
    $data = fgetcsv($handleData); //ignores title
    $data = fgetcsv($handleData); //ignores headers
    while($data = fgetcsv($handleData)){
        $data[0] = findNextId(FILE_NAME);
        fputcsv($handleOrig,$data);
    }

    fclose($handleOrig);
    fclose($handleData);
    unlink($newDataFile);
    
    header("Location: index.php");
}

//function to export data from a search result
function exportSearch(){
    // output headers so that the file is downloaded
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename='.get('search').'.csv');

    //create output stream
    $output = fopen('php://output', 'w'); 
    $handle = fopen('temp_search_results.csv','r');

    //loop through file where data is stored and copy to output file
    while($data = fgetcsv($handle)){ 
        fputcsv($output,$data);
    }
    fclose($output);
    fclose($handle);
}

//variable to add to php action links for editing records
$editUrl = 'edit_record.php?id='.get('id').'&date='.get('date').'&type='.get('type').'&artist='.get('artist').'&title='.get('title').'&accession='.get('accession');

//function to show alert boxes for successful events
function phpAlert($msg) {
    echo '<script type="text/javascript">alert("' . $msg . '")</script>';
}

?>