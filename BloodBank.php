<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body style="background-color: pink">
	
	<h1 style="text-align:center">Blood Bank Table</h1><br />
	<h3>Insert Quantity for specific Blood Group (A+, A-, B+, B-, O+, O-, AB+, AB-) in Blood Bank Table</h3>
	<form action="" method="post">
   	
	<label>Blood Group:</label>
	<p><input type="text" name="BloodGroup" /> </p>
	
	<label>Quantity(in bags):</label>
	<p><input type="text" name="Quantity" /> </p>
	
	<p><input type="reset" name="reset" value="Reset" /> &nbsp; &nbsp;
	
	<input type="submit" name="submit" value="Insert" /></p>
	


</form>
<?php
//require db connection script

if(isset($_POST['submit'])){
	require_once "bloodbank_connect.php";
	
	$BloodGroup=$_POST['BloodGroup'];
	$Quantity=$_POST['Quantity'];
	
	global $dbConn;
	
//update query statement
$insert = "Update BloodBank Set Quantity='$Quantity' Where BloodGroup='$BloodGroup';";

try{
	//prepare Query
	$statement = $dbConn->prepare($insert);
	
	//execute Query
	$statement->execute();
	
	//release db connector
	$statement->closeCursor();
}
catch(PDOException $ex){
	//get error Message
	$ex->getMessage();
	
}
function get_results(){
global $dbConn;	


$select = "SELECT * FROM BloodBank
				ORDER BY BloodTypeID";
				
//use PDO try-catch to run Query
try{
	//prepare query statement
	$statement = $dbConn->prepare($select);

    //execute Query
	$statement->execute();
	
    //fetcch query results
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    //release db connector Cursor
    $statement->closeCursor();

    //return result
    return $results;
}

catch(PDOException $ex){
	//get error Message
	$ex->getMessage();
	
}
}
$myresults =get_results();

//Displaying blood bank table
print "<table border=1><tr><td>BloodTypeID</td><td>BloodGroup</td><td>Quantity</td></tr>";
for($i=0;$i<count($myresults);$i++){
	$fetched=$myresults[$i];
    print "<tr><td>".$fetched['BloodTypeID']."</td><td>".$fetched['BloodGroup']."</td><td>".$fetched['Quantity']."</td></tr>";

	}		

print "</table>";

}
?>

<br /><br />	
<a href="bloodbank_user_interface.php">Click here to go back to main page</a><br>


</body>
</html>