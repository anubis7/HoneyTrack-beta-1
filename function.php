<?php
//	###########################	//
//	###########################	//
//	####### x77 Project #######	//
//	###########################	//
//	### Author: Mario Parra	###	//
//	### @MPAlonso_			###	//
//	###########################	//

function riseup(){			#Función para levantar la conexion con la BD
	$conection = condb();
}

function condb(){			#Conexión con la BD ["Host", "Usuario", "Password"]
	$conection = @mysqli_connect("localhost", "root", "","master");
	if (mysqli_connect_errno() != 0) {
		echo "Error connecting to database";
	}
	return $conection;
}

function dbquery($condb, $query){ 		#Funcion para la consulta a la base de datos
	if(!mysqli_query($condb, $query)){
		echo "Query Failed";
	}
}

function QueryAttack(){					
	$conection = condb();
	dbquery($conection, "USE master"); #master en la MV
	$query = "SELECT ip, starttime, endtime FROM sessions ORDER BY starttime DESC";
	$result = mysqli_query($conection, $query);
	$arrayrow = array();
	if (mysqli_query($conection, $query)){
		
		while ($row = mysqli_fetch_row($result)){
			$arrayrow[] = $row;
		}

	}	
	return $arrayrow;
}
function QueryAttacktoFile(){
	header("Content-type: text/plain");
   header("Content-Disposition: attachment; filename=attacks.txt");					
	$conection = condb();
	dbquery($conection, "USE master"); #master en la MV
	$query = "SELECT ip FROM sessions";
	$result = mysqli_query($conection, $query);
	$store = " ";
	if (mysqli_query($conection, $query)){
		
		while ($row = mysqli_fetch_row($result)){
			
			print $row[0]."\n";
		}
	}
	
}

function QueryIpAttack($ip){			#Función para ver los ataques de una IP en concreto
	$conection = condb();
	dbquery($conection, "USE master"); #master en la MV
	$query = "SELECT ip, starttime, endtime FROM sessions WHERE ip='$ip'";
	$result = mysqli_query($conection, $query);	
	$arrayrow = array();
	if (mysqli_query($conection, $query)){
		
		while ($row = mysqli_fetch_row($result)){
			$arrayrow[] = $row;
		}

	}
	return $arrayrow;
}
function searchcountry($pais){
	$conection = condb();
	dbquery($conection, "USE master"); #master en la MV
	$query = "SELECT paisid, pais FROM geoip where pais='$pais'";
	$result = mysqli_query($conection, $query);

	if (mysql_num_rows($result)>0){
		$row = mysql_fetch_row($result);
		return $row;
	}
	else
		return "No rows found";
}

function UserPass(){
	$conection = condb();
	dbquery($conection, "USE master"); #master en la MV
	$query = "SELECT session, username, password FROM auth";
	$result = mysqli_query($conection, $query);
	$arrayrow = array();
	if (mysqli_query($conection, $query)){
		while ($row = mysqli_fetch_row($result)){
			$arrayrow[] = $row;
		}

	}
	return $arrayrow;
}

function AttackOneSession($id){
	$conection = condb();
	dbquery($conection, "USE master"); #master en la MV
	$query = "SELECT id, ip FROM SESSIONS where id ='$id'";
	$result = mysqli_query($conection, $query);
	$arrayrow = array();
	if (mysqli_query($conection, $query)){
		while ($row = mysqli_fetch_row($result)){
			$arrayrow[] = $row;
		}
	}
	return $arrayrow;
}
function AttackSession(){
	$conection = condb();
	dbquery($conection, "USE master"); #master en la MV
	$query = "SELECT id, ip FROM SESSIONS";
	$result = mysqli_query($conection, $query);
	$arrayrow = array();
	if (mysqli_query($conection, $query)){
		while ($row = mysqli_fetch_row($result)){
			$arrayrow[] = $row;
		}
	}
	return $arrayrow;
}
function SearchCountryAttack($pais){ #Buscar ataques por pais

	$conection = condb(); #Conectar con BD
	dbquery($conection, "USE master");
	$query = "SELECT ipini, ipfin, paisid FROM geoip where paisid='".$pais."'";
	$result = mysqli_query($conection, $query);
	$queryipattack = "SELECT ip FROM sessions";
	$arrayip = array();
	if (mysqli_query($conection, $query)){
		$resultattack = mysqli_query($conection,$queryipattack);
		while($rowattack = mysqli_fetch_row($resultattack)){ #Saca las IP que han atacado
			$splitattack= explode(".",$rowattack[0]);
			$oct1ip = (int)$splitattack[0];
			$oct2ip = (int)$splitattack[1];
			$oct3ip = (int)$splitattack[2];
			$oct4ip = (int)$splitattack[3];
			$aux=buscarAttack($oct1ip,$oct2ip,$oct3ip,$oct4ip,$pais);
			if($aux){
				$arrayip[] = $aux;
				}
		}
	}
	return $arrayip; 	
}
function buscarAttack($oct1ip,$oct2ip,$oct3ip,$oct4ip,$pais){
	$stringResult=null;
	$conection = condb(); #Conectar con BD
	dbquery($conection, "USE master");
	$query = "SELECT ipini, ipfin, paisid FROM geoip where paisid='".$pais."'";
	$result = mysqli_query($conection, $query);
	while ($row = mysqli_fetch_row($result)){
		#Dividir IP Inicial
		$splitipini = explode(".",$row[0]);
		$oct1ipini = (int)$splitipini[0];
		$oct2ipini = (int)$splitipini[1];	
		$oct3ipini = (int)$splitipini[2];
		$oct4ipini = (int)$splitipini[3];
		#Dividir IP FInal
		$splitipfin = explode(".",$row[1]);
		$oct1ipfin = (int)$splitipfin[0];
		$oct2ipfin = (int)$splitipfin[1];	
		$oct3ipfin = (int)$splitipfin[2];
		$oct4ipfin = (int)$splitipfin[3];
		if($oct1ip >= $oct1ipini && $oct1ip <= $oct1ipfin &&
			$oct2ip >= $oct2ipini && $oct2ip <= $oct2ipfin && 
			$oct3ip >= $oct3ipini && $oct3ip <= $oct3ipfin && 
			$oct4ip >= $oct4ipini && $oct4ip <= $oct4ipfin){
			$stringResult=$oct1ip . "." . $oct2ip . "." . $oct3ip . "." . $oct4ip." ".$row[2];
			return $stringResult;
		}
	}
	//$stringResult=$oct1ip . "." . $oct2ip . "." . $oct3ip . "." . $oct4ip." NO ES DE ESTE PAIS<br>";
	return $stringResult;
}
function getGeocodeIPs($arrayIps){
	$arrayLatLng=array();
	foreach ($arrayIps as $ip){
		$meta=getLatAndLngFromIp($ip);
		$latitud = $meta['geoplugin_latitude'];
		$longitud = $meta['geoplugin_longitude'];
	     
	    // google map geocode api url
	    $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitud.",".$longitud."&key=AIzaSyDk7tF0HN2c5abGBRv5d3tDuK-dRkRiJ8k&sensor=true";
	    // get the json response
	    $resp_json = file_get_contents($url);
	     
	    // decode the json
	    $resp = json_decode($resp_json, true);
	    // response status will be 'OK', if able to geocode given address 
	    if($resp['status']=='OK'){
	 
	        // get the important data
	        $lati = $resp['results'][0]['geometry']['location']['lat'];
	        $longi = $resp['results'][0]['geometry']['location']['lng'];
	        $formatted_address = $resp['results'][0]['formatted_address'];
	         
	        // verify if data is complete
	        if($lati && $longi && $formatted_address){
	         
	            // put the data in the array
	            $data_arr = array();            
	             
	            array_push(
	                $data_arr, 
	                    $lati, 
	                    $longi, 
	                    $formatted_address,
	                    $ip
	                );
	             
	            $arrayLatLng[]= $data_arr;
	             
	        }
	    }
	}
	return $arrayLatLng;
}




function SearchAllAttack(){
	#var_dump($pais);
	#die();
	$conection = condb(); #Conectar con BD
	dbquery($conection, "USE master");
	$queryipattack = "SELECT ip, count(ip) FROM sessions group by ip";
	$arrayip = array();
	$arraydestino = array();
	if (mysqli_query($conection,$queryipattack)){
		$resultattack = mysqli_query($conection,$queryipattack);
		while($rowattack = mysqli_fetch_row($resultattack)){ #Saca las IP que han atacado
			$splitattack= explode(".",$rowattack[0]);
			$oct1ip = (int)$splitattack[0];
			$oct2ip = (int)$splitattack[1];
			$oct3ip = (int)$splitattack[2];
			$oct4ip = (int)$splitattack[3];
			$aux=buscarPaisfromIP($oct1ip,$oct2ip,$oct3ip,$oct4ip);
			if (isset($arrayip[$aux])){
				$arrayip[$aux] += intval($rowattack[1]);
			}
			else
				$arrayip[$aux] = intval($rowattack[1]);
		}
		while(!empty($arrayip)){
			$maxkey = null;
			$maxvalue = 0;
			foreach($arrayip as $key=>$value){
				if($value > $maxvalue){
					$maxvalue = $value;
					$maxkey = $key;
					}
			}
			$arraydestino[$maxkey] = $maxvalue;
			unset($arrayip[$maxkey]);
		}
	} 	
	return $arraydestino;
}
function buscarPaisfromIP($oct1ip,$oct2ip,$oct3ip,$oct4ip){
	$conection = condb(); #Conectar con BD
	dbquery($conection, "USE master");
	$query = "SELECT ipini, ipfin, pais FROM geoip";
	$result = mysqli_query($conection, $query);
	while ($row = mysqli_fetch_row($result)){
		#Dividir IP Inicial
		$splitipini = explode(".",$row[0]);
		$oct1ipini = (int)$splitipini[0];
		$oct2ipini = (int)$splitipini[1];	
		$oct3ipini = (int)$splitipini[2];
		$oct4ipini = (int)$splitipini[3];
		#Dividir IP FInal
		$splitipfin = explode(".",$row[1]);
		$oct1ipfin = (int)$splitipfin[0];
		$oct2ipfin = (int)$splitipfin[1];	
		$oct3ipfin = (int)$splitipfin[2];
		$oct4ipfin = (int)$splitipfin[3];
		if($oct1ip >= $oct1ipini && $oct1ip <= $oct1ipfin &&
			$oct2ip >= $oct2ipini && $oct2ip <= $oct2ipfin && 
			$oct3ip >= $oct3ipini && $oct3ip <= $oct3ipfin && 
			$oct4ip >= $oct4ipini && $oct4ip <= $oct4ipfin){
			$stringResult= $row[2];
			return $stringResult;
			}
	}
	return null;

}
function GeoLocAttack() {
	// var_dump($pais);
	// die();
	$conection = condb (); // Conectar con BD
	dbquery ( $conection, "USE master" );
	$query = "SELECT ipini, ipfin, paisid FROM geoip";
	$result = mysqli_query ( $conection, $query );
	$queryipattack = "SELECT distinct ip, count(ip) FROM sessions group by ip ";
	$arrayip = array ();
	if (mysqli_query ( $conection, $query )) {
		$resultattack = mysqli_query ( $conection, $queryipattack );
		while ( $rowattack = mysqli_fetch_row ( $resultattack ) ) { // Saca las IP que han atacado
			$splitattack = explode ( ".", $rowattack [0] );
			$oct1ip = ( int ) $splitattack [0];
			$oct2ip = ( int ) $splitattack [1];
			$oct3ip = ( int ) $splitattack [2];
			$oct4ip = ( int ) $splitattack [3];
			$aux = SearchLocAttack ( $oct1ip, $oct2ip, $oct3ip, $oct4ip );
			if ($aux){
				$arrayip[]= $aux;
			}
		}
	}
	return $arrayip;
}
function SearchLocAttack($oct1ip,$oct2ip,$oct3ip,$oct4ip){
	$conection = condb(); #Conectar con BD
	dbquery($conection, "USE master");
	$query = "SELECT ipini, ipfin, paisid, locini, locfin FROM geoip";
	$result = mysqli_query($conection, $query);
	while ($row = mysqli_fetch_row($result)){
		#Dividir IP Inicial
		$splitipini = explode(".",$row[0]);
		$oct1ipini = (int)$splitipini[0];
		$oct2ipini = (int)$splitipini[1];	
		$oct3ipini = (int)$splitipini[2];
		$oct4ipini = (int)$splitipini[3];
		#Dividir IP FInal
		$splitipfin = explode(".",$row[1]);
		$oct1ipfin = (int)$splitipfin[0];
		$oct2ipfin = (int)$splitipfin[1];	
		$oct3ipfin = (int)$splitipfin[2];
		$oct4ipfin = (int)$splitipfin[3];
		if($oct1ip >= $oct1ipini && $oct1ip <= $oct1ipfin &&
			$oct2ip >= $oct2ipini && $oct2ip <= $oct2ipfin && 
			$oct3ip >= $oct3ipini && $oct3ip <= $oct3ipfin && 
			$oct4ip >= $oct4ipini && $oct4ip <= $oct4ipfin){
			$arrayResult=array();
   			$arrayResult[]=$oct1ip . "." . $oct2ip . "." . $oct3ip . "." . $oct4ip;
   			$arrayResult[]=$row[2];
   			return $arrayResult;
		}
	}
}
function QueryAttacktoMap(){					
	$conection = condb();
	dbquery($conection, "USE master"); #master en la MV
	$query = "SELECT distinct(ip) FROM sessions ORDER BY starttime DESC LIMIT 30";
	$arrayrow = array();
	$result = mysqli_query($conection, $query);	
	if (mysqli_query($conection, $query)){
		while ($row = mysqli_fetch_row($result)){
			 $arrayrow[] = $row[0];
		}
	}
	return $arrayrow;
}
function getLatAndLngFromIp($ip){
	$meta = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
	return $meta;
}

function Input() {
	$conection = condb ();
	dbquery ( $conection, "USE master" ); // master en la MV
	$query = "SELECT session, input FROM INPUT ORDER BY timestamp DESC";
	$result = mysqli_query ( $conection, $query );
	$arrayrow = array ();
	if (mysqli_query ( $conection, $query )) {
		while ( $row = mysqli_fetch_row ( $result ) ) {
			$arrayrow [] = $row;
		}
	}
	return $arrayrow;
}
function AllAttacks() {
	$db = new SQLite3 ( 'db/dionaea.sqlite' );
	$query = $db->query ( 'SELECT connection,connection_type,connection_transport,connection_protocol,local_port,remote_host,remote_port FROM connections' );
	$arrayrows = array ();
	while ( $row = $query->fetchArray () ) {
		$arrayrows [] = $row;
	}
	return $arrayrows;
}
/**
 * Funcion que muestra los Logins en dionaea
 *
 * @return array:logins:
 */
function Logins() {
	$db = new SQLite3 ( 'db/dionaea.sqlite' );
	$query = $db->query ( 'SELECT connection,login_username,login_password FROM logins' );
	$arrayrows = array ();
	while ( $row = $query->fetchArray () ) {
		$arrayrows [] = $row;
	}
	return $arrayrows;
}
/**
 * Funcion que muestra las conexiones en dionaea
 *
 * @return array:connection:
 */
function FindConnection($connection) {
	$db = new SQLite3 ( 'db/dionaea.sqlite' );
	$query = $db->query ( "SELECT connection,connection_type,connection_transport,connection_protocol,local_port,remote_host,remote_port FROM connections where connection='" . $connection . "'" );
	$arrayrows = array ();
	while ( $row = $query->fetchArray () ) {
		$arrayrows [] = $row;
	}
	return $arrayrows;
}
/* ================ FUNCTION OF GLASTOPF =================== */
/**
 * Funcion que calcula los ataques
 *
 * @return array:attackglastopf:
 */
function inurlAttack() {
	$conection = condb ();
	dbquery ( $conection, "USE glaspot" ); // glaspot DB
	$query = "SELECT count, content FROM inurl ORDER BY count DESC LIMIT 30";
	$arrayrow = array ();
	$result = mysqli_query ( $conection, $query );
	if (mysqli_query ( $conection, $query )) {
		while ( $row = mysqli_fetch_row ( $result ) ) {
			$arrayrow [] = $row;
		}
	}
	return $arrayrow;
}
function filetypeAttack() {
	$conection = condb ();
	dbquery ( $conection, "USE glaspot" ); // glaspot DB
	$query = "SELECT count, content FROM filetype ORDER BY count DESC LIMIT 30";
	$arrayrow = array ();
	$result = mysqli_query ( $conection, $query );
	if (mysqli_query ( $conection, $query )) {
		while ( $row = mysqli_fetch_row ( $result ) ) {
			$arrayrow [] = $row;
		}
	}
	return $arrayrow;
}
function events() {
	$conection = condb ();
	dbquery ( $conection, "USE glaspot" ); // glaspot DB
	$query = "SELECT source, request_url FROM events LIMIT 30";
	$arrayrow = array ();
	$result = mysqli_query ( $conection, $query );
	if (mysqli_query ( $conection, $query )) {
		while ( $row = mysqli_fetch_row ( $result ) ) {
			$arrayrow [] = $row;
		}
	}
	return $arrayrow;
}
// ============= FUNCTION STATISTICS=============== */
function statsUsernamePassKippo() {
	$conection = condb ();
	dbquery ( $conection, "USE master" );
	$query = "SELECT count(*),`username`,`password` FROM auth WHERE 1 group by username,password";
	$arrayrow = array ();
	$result = mysqli_query ( $conection, $query );
	if (mysqli_query ( $conection, $query )) {
		while ( $row = mysqli_fetch_row ( $result ) ) {
			$arrayrow [] = $row;
		}
	}
	return $arrayrow;
}
function statsCountryAttackKippo() {
	$conection = condb ();
	dbquery ( $conection, "USE master" );
	$query = "SELECT paisid FROM geoip where 1 group by paisid";
	$arrayrow = array ();
	$result = mysqli_query ( $conection, $query );
	if (mysqli_query ( $conection, $query )) {
		while ( $row = mysqli_fetch_row ( $result ) ) {
			$arrayrow [] = $row;
		}
	}
	$arraygeolocattack = array ();
	$arraygeolocattack = GeoLocAttack ();
	$arrayresultado = array();
	foreach ( $arrayrow as $aux ) {
		$objresult = array();
		$objresult[] = $aux[0];
		$cont = 0;
		foreach ( $arraygeolocattack as $geo ) {
			if ($aux[0] == $geo [1]) {
				$cont++;

			}
		}
		if ($cont > 0){
			$objresult[] = $cont;
			$arrayresultado[] = $objresult;
		}
	}
	return $arrayresultado;
}

function statsAllAttacksDionaea() {
	$db = new SQLite3 ( 'db/dionaea.sqlite' );
	$query = $db->query ( 'SELECT connection_protocol, count(connection_protocol) FROM connections group by connection_protocol;' );
	$arrayrows = array ();
	while ( $row = $query->fetchArray () ) {
		$arrayrows [] = $row;
	}
	return $arrayrows;
}

function statsUrlAttacksGlastopf(){
	$conection = condb ();
	dbquery ( $conection, "USE glaspot" ); // glaspot DB
	$query = "SELECT content, count FROM inurl ORDER BY count DESC LIMIT 30";
	$arrayrow = array ();
	$result = mysqli_query ( $conection, $query );
	if (mysqli_query ( $conection, $query )) {
		while ( $row = mysqli_fetch_row ( $result ) ) {
			$arrayrow [] = $row;
		}
	}
	return $arrayrow;
}

?>
