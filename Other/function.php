<?php
function user_add($link, $nameUser, $emailUser, $passwordUser, $phoneUser, $addressUser){
	$query_check = "SELECT * FROM user WHERE email = '$emailUser'";
	$result_check = mysqli_query($link, $query_check);

	if($result_check)
		if( mysqli_num_rows($result_check) < 1){
	
			$t = "INSERT INTO user (email, password, name, phone, address) VALUES ('%s', '%s', '%s', '%s', '%s')";
	
			$query = sprintf($t, mysqli_real_escape_string($link, $emailUser),
				mysqli_real_escape_string($link, $passwordUser),
    			mysqli_real_escape_string($link, $nameUser),
    			mysqli_real_escape_string($link, $phoneUser),
				mysqli_real_escape_string($link,$addressUser));

			$result = mysqli_query($link, $query);
			
			if ($result){
				if(!$result){
					die(mysqli_error($link));
				}
	
				return true;
			
			}else{
				return false;
			}
		}

		return false;
}


function checkAuth($link, $loginUser, $passwordUser){
	$query = "SELECT * FROM user WHERE ((email = '$loginUser') AND (password = '$passwordUser'))";
	$result = mysqli_query($link, $query);

	if($result)
		if( mysqli_num_rows($result) > 0){
			return "user";
	}
	
	$query = "SELECT * FROM doctor WHERE ((login = '$loginUser') AND (password = '$passwordUser'))";
	$result = mysqli_query($link, $query);

	if($result)
		if( mysqli_num_rows($result) > 0){
			return "doctor";
	}
	
	$query = "SELECT * FROM admin WHERE ((login = '$loginUser') AND (password = '$passwordUser'))";
	$result = mysqli_query($link, $query);

	if($result)
		if( mysqli_num_rows($result) > 0){
			return "admin";
	}

	if(!$result){
		die(mysqli_error($link));
	}

	return false;
}

function petView($link){
	$query = "SELECT * FROM pet ORDER BY id DESC";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);
	$pets = array();

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$pets[] = $row;
	}
	return $pets;
}


function petOwnerView($link, $id){
	$query = "SELECT name FROM user WHERE id = '$id'";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_array($result);
		$nameOwner = $row['name'];
	}
	return $nameOwner;
}

function idForImagePet($link){
	$query = "SELECT * FROM pet ORDER BY id DESC";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result) + 1;
	return $n;
}


function addPet($link, $nameOwner, $alias, $kind, $breed, $age, $sex, $imgname, $imgpath){
	$t = "INSERT INTO pet (nameOwner, alias, kind, breed, age, sex, imgname, imgpath) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')";
	
	$query = sprintf($t, mysqli_real_escape_string($link, $nameOwner),
			mysqli_real_escape_string($link, $alias),
			mysqli_real_escape_string($link,$kind),
			mysqli_real_escape_string($link,$breed),
			mysqli_real_escape_string($link,$age),
			mysqli_real_escape_string($link,$sex),
			mysqli_real_escape_string($link,$imgname),
			mysqli_real_escape_string($link, $imgpath));

	$result = mysqli_query($link, $query);

	if(!$result)
		die(mysqli_error($link));

	return true;

}


function receptionsViews($link){
	$query = "SELECT * FROM schedule ORDER BY date DESC";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);
	$receptions = array();

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$receptions[] = $row;
	}
	return $receptions;
}


function doctorName($link, $id){
	$query = "SELECT ПІБ FROM doctor WHERE id = '$id'";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_array($result);
		$doctor = $row['ПІБ'];
	}
	return $doctor;
}

function petAlias($link, $id){
	$query = "SELECT alias FROM pet WHERE id = '$id'";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_array($result);
		$petAlias = $row['alias'];
	}
	return $petAlias;
}

function diagnosName($link, $id){
	$query = "SELECT name FROM diagnosis WHERE id = '$id'";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_array($result);
		$diagnosName = $row['name'];
	}
	return $diagnosName;
}


function diagnosisView($link){
	$query = "SELECT * FROM diagnosis ORDER BY id ASC";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);
	$diagnosis = array();

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$diagnosis[] = $row;
	}
	return $diagnosis;
}


function recordReception($link, $doctor, $pet, $diagnos, $date, $time){
	$t = "INSERT INTO schedule (doctor, pet, diagnos, date, time) VALUES ('%s', '%s', '%s', '%s', '%s')";
	
	$query = sprintf($t, mysqli_real_escape_string($link, $doctor),
			mysqli_real_escape_string($link, $pet),
			mysqli_real_escape_string($link,$diagnos),
			mysqli_real_escape_string($link,$date),
			mysqli_real_escape_string($link, $time));

	$result = mysqli_query($link, $query);

	if(!$result)
		die(mysqli_error($link));

	return true;

}

function doctorView($link){
	$query = "SELECT * FROM doctor ORDER BY id DESC";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);
	$doctors = array();

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$doctors[] = $row;
	}
	return $doctors;
}

function addDoctor($link, $login, $password, $name, $special, $cab, $exp){
	$t = "INSERT INTO doctor (login, password, ПІБ, Спеціальність, Кабінет, Стаж) VALUES ('%s', '%s', '%s', '%s', '%s', '%s')";
	
	$query = sprintf($t, mysqli_real_escape_string($link, $login),
			mysqli_real_escape_string($link, $password),
			mysqli_real_escape_string($link,$name),
			mysqli_real_escape_string($link,$special),
			mysqli_real_escape_string($link,$cab),
			mysqli_real_escape_string($link, $exp));

	$result = mysqli_query($link, $query);

	if(!$result)
		die(mysqli_error($link));

	return true;

}

function clientView($link){
	$query = "SELECT * FROM user ORDER BY id DESC";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);
	$clients = array();

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$clients[] = $row;
	}
	return $clients;
}

function addClient($link, $email, $password, $name, $phone, $address){
	$t = "INSERT INTO user (email, password, name, phone, address) VALUES ('%s', '%s', '%s', '%s', '%s')";
	
	$query = sprintf($t, mysqli_real_escape_string($link, $email),
			mysqli_real_escape_string($link, $password),
			mysqli_real_escape_string($link,$name),
			mysqli_real_escape_string($link,$phone),
			mysqli_real_escape_string($link, $address));

	$result = mysqli_query($link, $query);

	if(!$result)
		die(mysqli_error($link));

	return true;

}

function soloPetView($link, $id){
	$id = (int)$id;

	$query = sprintf("SELECT * FROM pet WHERE id=%d",$id);
	$result = mysqli_query($link, $query);

	if(!$result)
		die(mysqli_error($link));

	$pet = mysqli_fetch_assoc($result);

	return $pet;
}

function updatePet($link, $id, $alias, $kind, $breed, $age, $sex){
	$age = (int)$age;

	$query = sprintf("UPDATE pet SET alias = '$alias', kind = '$kind', breed = '$breed', age = '$age', sex = '$sex' WHERE id=%d",$id);
	$result = mysqli_query($link, $query);
	if(!$result)
		die(mysqli_error($link));

	return mysqli_affected_rows($link);
}

function petDelete($link, $id){
	$id = (int)$id;
	
	$query = sprintf("DELETE FROM pet WHERE id=%d",$id);
	$result = mysqli_query($link, $query);

	if(!$result)
		die(mysqli_error($link));

	return mysqli_affected_rows($link);
}

function doctorDelete($link, $id){
	$id = (int)$id;
	
	$query = sprintf("DELETE FROM doctor WHERE id=%d",$id);
	$result = mysqli_query($link, $query);

	if(!$result)
		die(mysqli_error($link));

	return mysqli_affected_rows($link);
}

function soloDocView($link, $id){
	$id = (int)$id;

	$query = sprintf("SELECT * FROM doctor WHERE id=%d",$id);
	$result = mysqli_query($link, $query);

	if(!$result)
		die(mysqli_error($link));

	$doc = mysqli_fetch_assoc($result);

	return $doc;
}

function updateDoctor($link, $id, $login, $password, $name, $special, $cab, $exp){

	$query = sprintf("UPDATE doctor SET login = '$login', password = '$password', ПІБ = '$name', Спеціальність = '$special', Кабінет = '$cab', Стаж = '$exp' WHERE id=%d",$id);
	$result = mysqli_query($link, $query);
	if(!$result)
		die(mysqli_error($link));

	return mysqli_affected_rows($link);
}

function soloClientView($link, $id){
	$id = (int)$id;

	$query = sprintf("SELECT * FROM user WHERE id=%d",$id);
	$result = mysqli_query($link, $query);

	if(!$result)
		die(mysqli_error($link));

	$client = mysqli_fetch_assoc($result);

	return $client;
}

function updateClient($link, $id, $email, $password, $name, $phone, $address){

	$query = sprintf("UPDATE user SET email = '$email', password = '$password', name = '$name', phone = '$phone', address = '$address' WHERE id=%d",$id);
	$result = mysqli_query($link, $query);
	if(!$result)
		die(mysqli_error($link));

	return mysqli_affected_rows($link);
}

function clientDelete($link, $id){
	$id = (int)$id;
	
	$query = sprintf("DELETE FROM user WHERE id=%d",$id);
	$result = mysqli_query($link, $query);

	if(!$result)
		die(mysqli_error($link));

	return mysqli_affected_rows($link);
}

function idUser($link, $login){
	$query = "SELECT id FROM user WHERE email = '$login'";
	$result = mysqli_query($link, $query);
	
	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_array($result);
		$idUser = $row['id'];
	}
	return $idUser;
}

function petViewForClient($link, $idUser){
	$query = "SELECT * FROM pet WHERE id = '$idUser'";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);
	$pets = array();

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$pets[] = $row;
	}
	return $pets;
}

function checkReception($link, $doctor, $pet, $date, $time){
	$query = "SELECT * FROM schedule WHERE ((doctor = '$doctor') AND (date = '$date') AND (time = '$time'))";
	$result = mysqli_query($link, $query);

	if($result)
		if( mysqli_num_rows($result) > 0){
			return false;
	}

	$query = "SELECT * FROM schedule WHERE ((pet = '$pet') AND (date = '$date') AND (time = '$time'))";
	$result = mysqli_query($link, $query);

	if($result)
		if( mysqli_num_rows($result) > 0){
			return false;
	}

	return true;
}

function receptionDelete($link, $id){

	$id = (int)$id;
	
	$query = sprintf("DELETE FROM schedule WHERE id=%d",$id);
	$result = mysqli_query($link, $query);

	if(!$result)
		die(mysqli_error($link));

	return mysqli_affected_rows($link);
}

function receptionPeriod($link, $startDate, $endDate){
	
	$query = "SELECT * FROM schedule WHERE (date BETWEEN '$startDate' AND '$endDate')";
	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);
	$receptions = array();

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$receptions[] = $row;
	}
	return $receptions;
}

function servByMonths($link){
	$query = "SELECT MONTH(schedule.date) AS month_num, SUM(diagnosis.price) AS total FROM schedule JOIN diagnosis ON schedule.diagnos = diagnosis.id GROUP BY month_num";

	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);
	$date = array();

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$date[$row['month_num']] = $row['total'];
	}
	return $date;
}

function docAnalysis($link){
	$query = "SELECT doctor.ПІБ AS doc_name, COUNT(schedule.doctor) AS count_doc  FROM doctor JOIN schedule ON doctor.id  = schedule.doctor GROUP BY doc_name";

	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);
	$date = array();

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$date[$row['doc_name']] = $row['count_doc'];
	}
	return $date;
}

function bestDoc($link, $count){
	$query = sprintf("SELECT doctor.ПІБ AS doc_name, COUNT(schedule.doctor) AS count_doc  FROM doctor JOIN schedule ON doctor.id  = schedule.doctor GROUP BY doc_name HAVING count_doc =%d", $count);

	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);
	$date = array();

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$date[$row['doc_name']] = $row['count_doc'];
	}
	return $date;
}

function petAnalysis($link){
	$query = "SELECT pet.kind AS pet_name, COUNT(schedule.pet) AS count_pet  FROM pet JOIN schedule ON pet.id  = schedule.pet GROUP BY pet_name";

	$result = mysqli_query($link,$query);

	if(!$result)
		die(mysqli_error($link));

	$n = mysqli_num_rows($result);
	$date = array();

	for($i = 0; $i < $n; $i++)
	{
		$row = mysqli_fetch_assoc($result);
		$date[$row['pet_name']] = $row['count_pet'];
	}
	return $date;
}
?>