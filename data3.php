<?Php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "themis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = "SELECT * FROM matters WHERE client_id=4";
$result = $conn->query($stmt);
//$stmt->execute();
$json = [];
$count = 0;
$status = [];


if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()){
    extract($row);
    $status = [(string)$row['status']];
    
    

    try{
        $case_stages=array("Start","Arrest","Bail","Arraignment","Pre-Trial Hearing","Pre-Trial Motions","Trial","Sentencing","Appeal","Closed");
        $stages=array();
        
foreach($case_stages as $cases){
    if($cases == $status && $cases>1)
    {
        $count++;
    }
        /*foreach ($case_stages as $value) {
            $stages[$value] = CourtBook::all()->where('stage',$value)->where('company_id',\Auth::user()->company_id)->count(); 
        }*/
        $count = count($status);
       
}   
    //echo $count;
    //print_r( $row);
}
catch(Exception $e) {
    echo 'Message: ' .$e->getMessage();
  }
    $json[]= [(string)$row['status'],$count];
  }
}

echo json_encode($json);
?>