<?php
error_reporting(E_PARSE);
if(isset($_POST["submit"])){

$nome = $_POST['nome'];
$whats = $_POST['whats'];
$email = $_POST['email'];
$data_nascimento = $_POST['data_nascimento'];
$pass = $_POST['pass'];

$nome2 = trim($nome);
$whats2 = trim($whats);

// $msg_explodida = (explode(" ",$mensagem));
// if(in_array($texto, $msg_explodida)){ 
//     $errMSG = "Mensagem não enviada";
// }

// function substr_in_array($needle, $haystack)
// {
//     /*** cast to array ***/
//     $needle = (array) $needle;

//     /*** map with preg_quote ***/
//     $needle = array_map('preg_quote', $needle);

//     /*** loop of the array to get the search pattern ***/
//     foreach ($needle as $pattern)
//     {
//         if (count(preg_grep("/$pattern/", $haystack)) > 0)
//         return true;
//     }
//     /*** if it is not found ***/
//     return false;
// }

// function phoneValidate($phone)
// {
//     $regex = '/^(?:(?:\+|00)?(55)\s?)?(?:\(?([1-9][0-9])\)?\s?)?(?:((?:9\d|[2-9])\d{3})\-?(\d{4}))$/';

//     if (preg_match($regex, $phone) == false) {

//         // O número não foi validado.
//         return false;
//     } else {

//         // Telefone válido.
//         return true;
//     }        
// }

// $strings = array('http', 'sexy', '<a', 'sex', 'sexual', 'pussy', 'tudo', 'photo', 'https', 'porn', 'porno' );

// if (substr_in_array( $strings, $msg_explodida ) == true) {
//     $errMSG = "Mensagem não enviada";
// }

// if (phoneValidate( $whats ) == false) {
//     $errMSG = "Por favor, insira um número válido";
// }

if(empty($nome2)){
    $errMSG = "Por favor insira o nome";
}

if(empty($whats2)){
    $errMSG = "Por favor insira um número";
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errMSG = "Email inválido";
}
if(!isset($errMSG))
{
    $stmt = $DB_con->prepare('INSERT INTO forms (nome,whats,email,data_nascimento,pass) VALUES(:unome,:uwhats,:uemail,:udata_nascimento,:upass)');
    $stmt->bindParam(':unome',$nome);
    $stmt->bindParam(':uwhats',$whats);
    $stmt->bindParam(':uemail',$email);
    $stmt->bindParam(':udata_nascimento',$data_nascimento);
    $stmt->bindParam(':upass',$pass);



    if($stmt->execute())
    {
      echo("<script>window.location = 'obrigado.php';</script>");
    }
    else
    {
        $errMSG = "Erro!";
    }
}
}
