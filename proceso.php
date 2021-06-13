
<?php
require 'requests/library/Requests.php';
Requests::register_autoloader();
require 'culqi/lib/culqi.php';

$SECRET_KEY = "sk_test_tcWcnYp4iWgHpZe5";
$culqi = new Culqi\Culqi(array('api_key' => $SECRET_KEY));

$charge = $culqi->Charges->create(
 array(
     "amount" => $_POST['precio'],
     "capture" => true,
     "des
     iption" => $_POST['producto'],
     "currency_code" => "PEN",
     "email" => $_POST['email'],
     "source_id" => $_POST['token']
 )
);

	echo "exitoso";

	exit();
?>
