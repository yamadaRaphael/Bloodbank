<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body style="background-color: pink">
	
	<h1 style="text-align:center">Disease Table</h1><br>
	<h3>Insert values in Disease Table</h3>
	<form action="" method="post">
   	
	<label>Disease Name:</label>
	<p><input type="text" name="Name" /> </p>
	
	<label>Disease Type:</label>
	<p><input type="text" name="Type" /> </p>
	
	<label>Disease Status:</label>
	<p><input type="text" name="Status" /> </p>
	
	
	<p><input type="reset" name="reset" value="Reset" /> &nbsp; &nbsp;
	
	<input type="submit" name="submit" value="Insert" /></p>
	


</form>
<?php

//require db connection script

if(isset($_POST['submit'])){
	require_once "bloodbank_connect.php";
	$Name=$_POST['Name'];
	$Type=$_POST['Type'];
	$Status=$_POST['Status'];

	global $dbConn;
	
//insert query statement
$insert = "INSERT INTO Disease(Name,Type,Status) VALUES(:Name,:Type,:Status)";

try{
	//prepare Query
	$statement = $dbConn->prepare($insert);
	
	//bind values to filed names
	$statement->bindValue(':Name',$Name);
	$statement->bindValue(':Type',$Type);
	$statement->bindValue(':Status',$Status);
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


$select = "SELECT * FROM Disease
				ORDER BY DiseaseID";
				
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

//Displaying Disease table
print "<table border=1><tr><td>DiseaseID</td><td>Name</td><td>Type</td><td>Status</td></tr>";
for($i=0;$i<count($myresults);$i++){
	$fetched=$myresults[$i];
    print "<tr><td>".$fetched['DiseaseID']."</td><td>".$fetched['Name']."</td><td>".$fetched['Type']."</td><td>".$fetched['Status']."</td></tr>";

	}		

print "</table>";

}
?>

<br /><br />	
<a href="bloodbank_user_interface.php">Click here to go back to main page</a><br>


</body>
</html>