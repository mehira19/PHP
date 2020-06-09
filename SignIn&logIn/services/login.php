<?php
set_include_path('..'.PATH_SEPARATOR);

require_once('lib/common_service.php');
require_once('lib/session_start.php');

if (isset($_SESSION['ident'])){
  produceError("déjà authentifié");
  return;
}

$args = new RequestParameters('post');
$args->defineNonEmptyString('pseudo');
$args->defineNonEmptyString('password');

if (!$args->isValid()){
   produceError('argument(s) invalide(s) --> '.implode(', ',$args->getErrorMessages()));
   return;
}
$data = new DataLayer();
$_SESSION['ident'] = $data->login($args->getValue('pseudo'), $args->getValue('password'));
if ($_SESSION['ident']) {
  produceResult($_SESSION['ident']);
}
else {
  produceError('Identifiant ou mot de passe incorecte');
}
