<?php


function listerUser($connex){
	$sql="SELECT prenom FROM CLIENT order by prenom ";

	$prep = $connex->query($sql);
    $res=$connex->prepare($sql);
    $res->execute();
    return $res;
}


function listerOrdinateur($connex) {
	$sql="SELECT ORDINATEUR.nom FROM ORDINATEUR";
    $res=$connex->prepare($sql);
    $res->execute();
    return $res;
}



//CONNEXION
function listerConnexionByPass($connex, $pass, $mail) {
    $sql="SELECT * FROM USERS WHERE password=? AND mail=?;";
    $res=$connex->prepare($sql);
    $res->execute(array($pass, $mail));
    return $res;
}

function listerAttribuerDateOrd($connex, $date, $ord, $hdeb){

	$sql="SELECT ATTRIBUER.hdeb, ATTRIBUER.date, ORDINATEUR.nom, CLIENT.prenom FROM ATTRIBUER INNER JOIN CLIENT ON idrefclient=idclient
																							  INNER JOIN ORDINATEUR ON idreford=idord
	WHERE date= '". $date . "' AND ORDINATEUR.nom='".$ord."' AND hdeb=".$hdeb.";";
    $prep = $connex->query($sql);
    $res = $prep->fetch(PDO::FETCH_NUM);
    return $res;

}



function supprAttr($connex, $date, $heure, $idreford){
	$sql="DELETE FROM ATTRIBUER where date=? AND hdeb=? AND idreford=?;";
	$res=$connex->prepare($sql);
	$res->execute(array($date, $heure, $idreford));
}


function addAttr($connex, $date, $heure, $idPrenom, $idOrd){
	$sql="INSERT INTO ATTRIBUER (idrefclient, idreford, date, hdeb) VALUES (?,?,?,?);";
	$res=$connex->prepare($sql);
	$res->execute( array($idPrenom, $idOrd, $date, $heure) );

}


function addOrdinateur($connex, $nom){
	$sql="INSERT INTO ORDINATEUR (nom) VALUES (?)";
	$res=$connex->prepare($sql);
	$res->execute(array($nom));
}

function addClient($connex, $prenom, $nom){
	$sql="INSERT INTO CLIENT (prenom, nom) VALUES (?,?)";
	$res=$connex->prepare($sql);
	$res->execute(array($prenom, $nom));
}




function listerIdClientByPrenom($connex, $prenom){
	$sql="SELECT idClient FROM CLIENT WHERE prenom=?";
    $res=$connex->prepare($sql);
    $res->execute(array($prenom));
    return $res;
}

function listerIdOrdByNom($connex, $nom){
	$sql="SELECT idOrd FROM ORDINATEUR WHERE nom=?";
    $res=$connex->prepare($sql);
    $res->execute(array($nom));
    return $res;
}


function supprOrdinateur($connex, $nom){
	$sql="DELETE FROM ORDINATEUR where nom=?;";
	$res=$connex->prepare($sql);
	$res->execute(array($nom));
}



?>