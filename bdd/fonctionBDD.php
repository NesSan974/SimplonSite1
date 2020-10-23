<?php



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
?>