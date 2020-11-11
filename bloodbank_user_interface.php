<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Blood Bank Management System</title>
	</head>
	<body style="background-color: palegreen">
	  <h1 style="text-align: center">Blood Bank Management System</h1>
	  &nbsp;&nbsp;
	  <h3>Enter Patient Details</h3> 
	  <form action="" method="post">
   	
     	<label>Patient ID:</label> &emsp;&emsp;&emsp;&emsp;&emsp;
	    <input type="text" name="PatientID" /><br><br>
	
	    <label>Quantity required(bags):</label>
	    <input type="text" name="Quantity" /> <br>

	    <p><input type="reset" name="reset" value="Reset" /> &nbsp; &nbsp;
	    <input type="submit" name="submit" value="Insert" /></p>
	
      </form>
	
<?php

if(isset($_POST['submit'])){
	
$PatientID=$_POST['PatientID'];
$Quantity=$_POST['Quantity'];
//echo ($PatientID);
require "bloodbank_connect.php";


//----------------Displaying PATIENT records---------------------------
try
{
	$select=$dbConn->prepare("select Patient.FirstName, Patient.LastName, Patient.Age, Disease.Name,Disease.Type, Department.DepName, Bloodbank.BloodGroup from Patient,Disease,Department,BloodBank where Patient.PatientID='$PatientID' and Patient.DiseaseID=Disease.DiseaseID and Patient.DepID=Department.DepID and Patient.BloodTypeID=BloodBank.BloodTypeID;");
$select->execute();
$selectresults=$select->fetchAll(PDO::FETCH_ASSOC);
//print_r($selectresults);
}
	
catch(PDOException $ex){
	//get error Message
	$ex->getMessage();
	
}

print "<h3>Patient Record</h3>";
print "<table border=1 style='border-collapse:collapse;text-align:center;'><tr><th>First Name</th><th>Last Name</th><th>Age</th><th>Disease Name</th><th>Disease Type</th><th>Department Name</th><th>Blood Group</th></tr>";
print "<tr><td>".$selectresults[0]['FirstName']."</td><td>".$selectresults[0]['LastName']."</td><td>".$selectresults[0]['Age']."</td><td>".$selectresults[0]['Name']."</td><td>".$selectresults[0]['Type']."</td><td>".$selectresults[0]['DepName']."</td><td>".$selectresults[0]['BloodGroup']."</td></tr></table>";


//------Retrieving Quantity---------------------------------
try{
	
	$query="select BloodBank.Quantity from BloodBank, Patient where Patient.PatientID='$PatientID' and Patient.BloodTypeID=BloodBank.BloodTypeID;";
$quantity=$dbConn->prepare($query);
$quantity->execute();
$totalResults = $quantity->fetchAll(PDO::FETCH_ASSOC);
$singleResult=$totalResults[0]['Quantity'];
//echo($singleResult);
}

catch(PDOException $ex){
	//get error Message
	$ex->getMessage();	
}

//-------Retrieving the BloodGroup---------------------------
try{
	
	$blood= $dbConn->prepare("select BloodBank.BloodTypeID from BloodBank, Patient where BloodBank.BloodTypeID=Patient.BLoodTypeID and Patient.PatientID='$PatientID';");
$blood->execute();
$bloodresult=$blood->fetchAll(PDO::FETCH_ASSOC);
print "<br><br>";
$singleblood=$bloodresult[0]['BloodTypeID'];
//echo($singleblood);
}

catch(PDOException $ex){
	//get error Message
	$ex->getMessage();
	
}
//----Updating Quantity of BloodGroup--------------------
if($Quantity<=$singleResult)
{
  print "The required number of ".$Quantity." blood bags are available in the Blood Bank";
  $difference= $singleResult-$Quantity;
 // echo($difference);
  
  $update=$dbConn->prepare("Update BloodBank Set Quantity='$difference' where BloodTypeId='$singleblood';");
  $update->execute();
  //echo("UPDATED");

} 
else{
  print "The required amount of Blood bags are not available in the Blood Bank<br><br>";
}

try{
	
//Displaying the BloodBank table after updating the Quantity of respective BloodGroup
$selectb=$dbConn->prepare("select * from BloodBank;");
$selectb->execute();
$selectbresults=$selectb->fetchAll(PDO::FETCH_ASSOC);
//print_r($selectresults);
}

catch(PDOException $ex){
	//get error Message
	$ex->getMessage();	
}
print "<h3>Blood Bank Status</h3>";
print "<table border=1 style='border-collapse:collapse;text-align:center;'><tr><th>BloodType ID</th><th>Blood Group</th><th>Updated Quantity(in bags)</th></tr>";
print "<tr><td>".$selectbresults[0]['BloodTypeID']."</td><td>".$selectbresults[0]['BloodGroup']."</td><td>".$selectbresults[0]['Quantity']."</td></tr></table>";


}		
?>
<br /><br />	
<a href="patient.php">Click here to insert data into Patient Table</a><br>
<a href="disease.php">Click here to insert data into Disease Table</a><br>
<a href="department.php">Click here to insert data into Department Table</a><br>
<a href="bloodbank.php">Click here to insert data into BloodBank Table</a><br>

	</body>
</html>