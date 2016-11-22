<?php
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set("America/Sao_Paulo");
$servername = "localhost";
$username = "golif749_encon";
$password = "V2tB1K,w}l;}";
$dbname = "golif749_goteam";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->query("SET NAMES 'utf8'");
$conn->query('SET character_set_connection=utf8');
$conn->query('SET character_set_client=utf8');
$conn->query('SET character_set_results=utf8');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$data_envio = date('d/m/Y');
$hora_envio = date('H:i:s');

if($nome == "" && $email == ""){
    exit("ERRO");
}

$sql_verifica = "select email from onelife where email = '$email' ";

if($conn->query($sql_verifica)->num_rows >= 1){
    exit('email_cadastrado');
}
//$EmailPadrao = "calebesouzavasconcelos@gmail.com";


$arquivo = "
	<style type='text/css'>
	body {
	margin:0px;
    font-family: sans-serif;
	}
	.content{
    padding: 40px; background:#f4f4f4;
    font-family: sans-serif;
   }
   .boxtxt{
    padding: 33px;
    border-radius: 7px;
    border:1px solid #ddd;font-family: sans-serif; background:#ffffff;
    font-family: sans-serif;
   }
   p,h1,h2{
    font-family: sans-serif;
   }
	</style>
    <html>
  <div style='padding: 40px; background:#f4f4f4;font-family: sans-serif;'>
  <div style='padding: 33px; border-radius: 7px; border:1px solid #ddd;font-family: sans-serif; background:#ffffff;font-family: sans-serif;'>
  <h1>Obrigado!</h1>
  <h2>ENCONTRO #GOTEAM</h2>
    <p>Recebemos sua solicita&ccedil;&atilde;o de interesse em participar dos nossos Encontros Goteam. Aguarde que entraremos em contato com voc&ecirc; o mais breve poss&iacute;vel.</p>
    
    <p><strong>Nome: </strong>$nome</p>
    <p><strong>E-mail: </strong>$email</p>
    <p>Este e-mail foi enviado em <b>$data_envio</b> &agrave;s <b>$hora_envio</b></p>
    <br>
    <br>
    <a href='http://www.golifecompany.com'><img src='http://golifecompany.com/assets/images/golife.png'></a>
    </div>
  </div>
</html>
";

$destino = $email;
$assunto = "Contato pelo Site OneLife";

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: contato@golifecompany.com "."\r\n";;//$nome <$email>";
$headers .= "Reply-To: contato@golifecompany.com"."\r\n";;
//$headers .= "Bcc: $EmailPadrao\r\n";
$enviaremail = mail($destino, $assunto, $arquivo, $headers);
$sql = "INSERT INTO  onelife (nome ,email ,datacad) VALUES ( '$nome', '$email' , now())";
if ($conn->query($sql) === TRUE) {
   // echo "New record created successfully";
} else {  //   echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
if($enviaremail){
    $mgm = "E-MAIL ENVIADO COM SUCESSO! <br> O link será enviado para o e-mail fornecido no formulário";
    //echo " <meta http-equiv='refresh' content='0;URL=index.php'>";
    echo "SUCESSO";
} else {
    $mgm = "ERRO AO ENVIAR E-MAIL!";
echo "ERRO";
}
//echo $mgm;
//echo $arquivo;
?>