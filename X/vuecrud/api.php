<?php

$conn = new mysqli("localhost", "root", "", "crud");
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$out = array('error' => false);

$crud = 'read';

if(isset($_GET['crud'])){
	$crud = $_GET['crud'];
}


if($crud == 'read'){
	$sql = "select * from members";
	$query = $conn->query($sql);
	$members = array();

	while($row = $query->fetch_array()){
		array_push($members, $row);
	}

	$out['members'] = $members;
}

if($crud == 'create'){

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];

	$sql = "insert into members (firstname, lastname) values ('$firstname', '$lastname')";
	$query = $conn->query($sql);

	if($query){
		$out['message'] = "Member Added Successfully";
	}
	else{
		$out['error'] = true;
		$out['message'] = "Could not add Member";
	}
	
}

if($crud == 'update'){

	$memid = $_POST['memid'];
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];

	$sql = "update members set firstname='$firstname', lastname='$lastname' where memid='$memid'";
	$query = $conn->query($sql);

	if($query){
		$out['message'] = "Member Updated Successfully";
	}
	else{
		$out['error'] = true;
		$out['message'] = "Could not update Member";
	}
	
}

if($crud == 'delete'){

	$memid = $_POST['memid'];

	$sql = "delete from members where memid='$memid'";
	$query = $conn->query($sql);

	if($query){
		$out['message'] = "Member Deleted Successfully";
	}
	else{
		$out['error'] = true;
		$out['message'] = "Could not delete Member";
	}
	
}


$conn->close();

header("Content-type: application/json");
echo json_encode($out);
die();


?>