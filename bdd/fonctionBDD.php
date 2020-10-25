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



function supprAttr($connex, $date, $heure){
	$sql="DELETE FROM ATTRIBUER where date=? AND hdeb=?;";
	$res=$connex->prepare($sql);
	$res->execute(array($date, $heure));
}


function addAttr($connex, $date, $heure, $idPrenom, $idOrd){
	$sql="INSERT INTO ATTRIBUER";
	$res=$connex->prepare($sql);
	$res->execute(array($date, $heure));
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


?>