<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body style="background-color: pink">
	
	<h1 style="text-align: center">Department Table</h1><br />
	<h3>Insert values in Department Table</h3>
	<form action="" method="post">
     
	
	<label>Department Name:</label>
	<p><input type="text" name="DepName" /> </p>
	
	
	<p><input type="reset" name="reset" value="Reset" /> &nbsp; &nbsp;
	
	<input type="submit" name="submit" value="Insert" /></p>
	


</form>
<?php
//require db connection script

if(isset($_POST['submit'])){
	require_once "bloodbank_connect.php";
	$DepName=$_POST['DepName'];

	global $dbConn;
	
//insert query statement
$insert = "INSERT INTO Department(DepName) VALUES(:DepName)";

try{
	//prepare Query
	$statement = $dbConn->prepare($insert);
	
	//bind values to filed names
	$statement->bindValue(':DepName',$DepName);
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


$select = "SELECT * FROM Department
				ORDER BY DepID";
				
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

//Displaying Department table
print "<table border=1><tr><td>DepID</td><td>DepName</td></tr>";
for($i=0;$i<count($myresults);$i++){
	$fetched=$myresults[$i];
    print "<tr><td>".$fetched['DepID']."</td><td>".$fetched['DepName']."</td></tr>";

	}		

print "</table>";

}
?>

<br /><br />	
<a href="bloodbank_user_interface.php">Click here to go back to main page</a><br>


</body>
</html>