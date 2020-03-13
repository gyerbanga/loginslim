<?php



$jsonData = array(
    'id_membres' => $_POST['id_membres']),
    'nom' => $_POST['nom']),
    'civilite' => $_POST['civilite']),
    'adresse' => $_POST['adresse']),
    'cp' => $_POST['cp']),
    'ville' => $_POST['ville']),
    'tel1' => $_POST['tel1']),
    'tel2' => $_POST['tel2']),
    'mail' => $_POST['mail']),
    'adhesion_date' => $_POST['adhesion_date']),
    'status' => $_POST['status']),
    'cotisation' => $_POST['cotisation']),
    'dons' => $_POST['dons'])
);

header('Content-type: application/json');
//Encode the array into JSON.
$jsonDataEncoded = json_encode($jsonData);
var_dump($jsonDataEncoded);
exit;
return $jsonDataEncoded :