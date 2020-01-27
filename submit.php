<?php
$servername="localhost";
$username="root";
$password="";
$dbname="studentdb";

$connect =mysqli_connect($servername, $username, $password, $dbname);
if(!$connect){
	die("connection failed: " .mysqli_connect_error());
}
else{
	echo "connected successfully";
}
/*$str =$_POST['data'];
echo $str;*/
//$name=[{'Name':'ronald','College':'Hogwarts'},{'Name':'Hagrid','College':'Hogwarts'}];
/*foreach ($variable as $key => $value) {
	
}*/
//$array_Name = array('hagrid' =>'hogwarts' ,'ronald'=>'hogwarts' );

//$sql="INSERT INTO data (name,college) VALUES ";
/*if(mysqli_query($conn,$sql)){
	echo "Records added successfully.";
}*/
$d=json_decode(file_get_contents("php://input"));

//if(count($d)>0){
	$n=mysqli_real_escape_string($connect,$d->name);
	$c=mysqli_real_escape_string($connect,$d->college);

	$query="INSERT INTO data (name,college) VALUES('$n','$c')";
	if(mysqli_query($connect,$query)){
		echo "data inserted";
	}
	else{
		echo "we have a problem :(";
	}
//}
?>