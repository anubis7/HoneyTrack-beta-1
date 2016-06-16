<?php
include 'function.php';
if (isset($_POST['option'])){
	$option=$_POST['option'];
	if ($option == "searchallattack"){
		$resultado = QueryAttack();
		if(empty($resultado)){
			echo "<h1>No se ha encontrado ningun ataque</h1>";	
		}
		else{
			$texto = "<table width='500' border='0'><tr><th scope='col'><b>IP</b></th><th scope='col'><b>Start Time</b></th><th scope='col'><b>End Time</b></th></tr>";
			foreach($resultado as $row){
				$texto.="<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td></tr>";
				}
			$texto.="</table>";
			echo $texto;
		}	
	} elseif ($option == "searchipattack") {
		if (isset ( $_POST ['ip'] ) && ! empty ( $_POST ['ip'] )) {
			$resultado = QueryIpAttack ( $_POST ['ip'] );
			if (empty ( $resultado )) {
				echo "<h1> IP not Found! </h1>";
			} else {
				$texto = "<table width='500' border='0'><tr><th scope='col'><b>IP</b></th><th scope='col'><b>Start Time</b></th><th scope='col'><b>End Time</b></th></tr>";
				foreach ( $resultado as $row ) {
					$texto .= "<tr><td>" . $row [0] . "</td><td>" . $row [1] . "</td><td>" . $row [2] . "</td></tr>";
				}
				$texto .= "</table>";
				echo $texto;
			}
		} else {
			echo "Introduce una IP";
		}
	} elseif ($option == "searchsessionattack") {
		if (isset ( $_POST ['id'] ) && ! empty ( $_POST ['id'] )) {
			$resultado = AttackOneSession ( $_POST ['id'] );
			if (empty ( $resultado )) {
				echo "<h1> Session not Found! </h1>";
			} else {
				$texto = "<table width='500' border='0'><tr><th scope='col'><b>ID Session</b></th><th scope='col'><b>IP</b></th></tr>";
				foreach ( $resultado as $row ) {
					$texto .= "<tr><td>" . $row [0] . "</td><td>" . $row [1] . "</td></tr>";
				}
				$texto .= "</table>";
				echo $texto;
			}
		} else {
			echo "Introduce una Session ID";
		}
	} elseif ($option == "searchcountry") {
		if (isset ( $_POST ['pais'] ) && ! empty ( $_POST ['pais'] )) {
			$resultado = SearchCountryAttack ( $_POST ['pais'] );
			if (empty ( $resultado )) {
				echo "<h1> Country not Found! </h1>";
			} else {
				$texto = "<table width='500' border='0'><tr><th scope='col'><b>IP-PAIS</b></th></tr>";
				foreach ( $resultado as $row ) {
					$texto .= "<tr><td>" . $row . "</td></tr>";
				}
				$texto .= "</table>";
				echo $texto;
			}
		} else {
			echo "Introduce un codigo de pais valido";
		}
	}elseif($option == "locattack"){
		$arrayIps = QueryAttacktoMap();
		$result = getGeocodeIPs($arrayIps);
		echo json_encode($result);
	} elseif ($option == "attackdio") {
		$resultado = AllAttacks ();
		if (empty ( $resultado )) {
			echo "<h1>No se ha encontrado ningun ataque</h1>";
		} else {
			$texto = "<table width='500' border='2'><tr><th scope='col' bgcolor='FBBD00'><b>Conection</b></th><th scope='col' bgcolor='FBBD00'><b>Type Conex</b></th><th scope='col' bgcolor='FBBD00'><b>Protocolo</b></th><th scope='col' bgcolor='FBBD00'><b>Protocol Conex</b></th><th scope='col' bgcolor='FBBD00'><b>Port Conexion Protocol<h3></h3></b></th><th scope='col' bgcolor='FBBD00'><b>IP</b><th scope='col' bgcolor='FBBD00'><b>Remote port</b></th></tr>";
			foreach ( $resultado as $row ) {
				$texto .= "<tr><td>" . $row [0] . "</td><td>" . $row [1] . "</td><td>" . $row [2] . "</td><td>" . $row [3] . "</td><td>" . $row [4] . "<td>" . $row [5] . "</td><td>" . $row [6] . "</td></tr>";
			}
			$texto .= "</table>";
			echo $texto;
		}
	} elseif ($option == "logindio") {
		$resultado = Logins ();
		if (empty ( $resultado )) {
			echo "<h1>No se ha encontrado ningun login</h1>";
		} else {
			$texto = "<table width='500' border='1'  ><tr><th scope='col' bgcolor='FBBD00'><b>Conection</b></th><th scope='col' bgcolor='FBBD00'><b>User</b></th><th scope='col' bgcolor='FBBD00'><b>Pass</b></th></tr>";
			foreach ( $resultado as $row ) {
				$texto .= "<tr><td>" . $row [0] . "</td><td>" . $row [1] . "</td><td>" . $row [2] . "</td></tr>";
			}
			$texto .= "</table>";
			echo $texto;
		}
	} elseif ($option == "searchconect") {
		if (isset ( $_POST ['conection'] ) && ! empty ( $_POST ['conection'] )) {
			$resultado = FindConnection ( $_POST ['conection'] );
			if (empty ( $resultado )) {
				echo "<h1> Conextion not Found! </h1>";
			} else {
				$texto = "<table width='500' border='1'><tr><th scope='col'><b>Conection</b></th><th scope='col'><b>Type Conex</b></th><th scope='col'><b>Protocolo</b></th><th scope='col'><b>Protocol Conex</b></th><th scope='col'><b>Port Conexion Protocol<h3></h3></b></th><th scope='col'><b>IP</b><th scope='col'><b>Remote port</b></th></tr>";
				foreach ( $resultado as $row ) {
					$texto.="<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."<td>".$row[5]."</td><td>".$row[6]."</td></tr>";
					//$texto .= "<tr><td>" . $row . "</td></tr>";
				}
				$texto .= "</table>";
				echo $texto;
			}
		} else {
			echo "Introduce un conexion valida";
		}
	} 

	elseif ($option == "inurlattack") {
		$resultado = inurlAttack ();
		if (empty ( $resultado )) {
			echo "<h1>No se ha encontrado ninguna url</h1>";
		} else {
			$texto = "<table width='500' border='1'><tr><th scope='col'><b>Count</b></th><th scope='col'><b>Content</b></th></tr>";
			foreach ( $resultado as $row ) {
				$texto .= "<tr><td>" . $row [0] . "</td><td>" . $row [1] . "</td></tr>";
			}
			$texto .= "</table>";
			echo $texto;
		}
	} elseif ($option == "filetypeattack") {
		$resultado = filetypeAttack ();
		if (empty ( $resultado )) {
			echo "<h1>No se ha encontrado ningun archivo</h1>";
		} else {
			$texto = "<table width='500' border='1'><tr><th scope='col'><b>Count</b></th><th scope='col'><b>Content</b></th></tr>";
			foreach ( $resultado as $row ) {
				$texto .= "<tr><td>" . $row [0] . "</td><td>" . $row [1] . "</td></tr>";
			}
			$texto .= "</table>";
			echo $texto;
		}
	} elseif ($option == "events") {
		$resultado = events ();
		if (empty ( $resultado )) {
			echo "<h1>No se ha encontrado ningun evento</h1>";
		} else {
			$texto = "<table width='500' border='1'><tr><th scope='col'><b>Source</b></th><th scope='col'><b>Request URL</b></th></tr>";
			foreach ( $resultado as $row ) {
				$texto .= "<tr><td>" . $row [0] . "</td><td>" . $row [1] . "</td></tr>";
			}
			$texto .= "</table>";
			echo $texto;
		}
	} elseif ($option == "input") {
		$resultado = Input ();
		if (empty ( $resultado )) {
			echo "<h1>No se ha encontrado ningun comando introducido</h1>";
		} else {
			$texto = "<table width='500' border='1'><tr><th scope='col'><b>Session</b></th><th scope='col'><b>Input</b></th></tr>";
			foreach ( $resultado as $row ) {
				$texto .= "<tr><td>" . $row [0] . "</td><td>" . $row [1] . "</td></tr>";
			}
			$texto .= "</table>";
			echo $texto;
		}
	}
	elseif ($option == "statsKippo") {
		$resultado = statsUsernamePassKippo();
		$obj = array();
		$obj['name'] = "Porcentaje Usuario y Password";
		$obj['colorByPoint'] = true;
		$obj['data']=array();
		foreach ($resultado as $aux){
			$data = array();
			$data['name'] ="User: ". $aux[1]." Pass: ". $aux[2];
			$data['y'] = intval($aux[0]);
			$obj['data'][] = $data;
			
		}
		$arrayObj=array();
		$arrayObj[]=$obj;
		
		
		$countryattack = statsCountryAttackKippo();
		$objcountry = array();
		//$objcountry['name'] = "Numero de ataques";
		$objcountry=array();
		foreach ($countryattack as $aux){
			$data = array();
			$data[] ="Pais: ". $aux[0]." No. Ataques: ". $aux[1];
			$data[] = intval($aux[1]);
			$objcountry[] = $data;
				
		}
		$objcountryresult = array();
		$objcountryresult['name']="Numero de ataques por pais";
		$objcountryresult['data'] = $objcountry;
		
		
		
		$arrayresultado = array();
		$arrayresultado[] = $arrayObj;
		$arrayresultado[] = $objcountryresult;
		//var_dump($arrayresultado);die();
	echo json_encode($arrayresultado);
	}
	elseif ($option == "statsDionaea") {
		$resultado = statsAllAttacksDionaea();
		$objdio = array();
		$objdio['name'] = "Ataques por protocolo";
		$objdio['colorByPoint'] = true;
		$objdio['data']=array();
		foreach ($resultado as $aux){
			$data = array();
			$data['name'] ="Protocolo: ". $aux[0]." No. Ataques: ". $aux[1];
			$data['y'] = intval($aux[1]);
			$objdio['data'][] = $data;
				
		}
		$arrayObj=array();
		$arrayObj[]=$objdio;
		//var_dump($arrayresultado);die();
		echo json_encode(array($objdio));
	}elseif ($option == "statsGlastopf") {
    	$resultado = statsUrlAttacksGlastopf();
    	$objdio = array();
    	$objdio['name'] = "Ataques por URL";
    	$objdio['colorByPoint'] = true;
    	$objdio['data']=array();
    	foreach ($resultado as $aux){
     	 	$data = array();
      		$data['name'] ="URL: ". $aux[0]." Ataques: ". $aux[1];
      		$data['y'] = intval($aux[1]);
      		$objdio['data'][] = $data;
  
    	}
    	$arrayObj=array();
   		$arrayObj[]=$objdio;
   		 echo json_encode(array($objdio));
	}
}

?>