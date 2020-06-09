<?php
set_include_path('..' . PATH_SEPARATOR);

require_once('lib/common_service.php');
require_once('lib/session_start.php');

$args = new RequestParameters('post');
$args->defineNonEmptyString('pseudo');
$args->defineNonEmptyString('password');

if ($args->isValid())
  try {
    $data = new DataLayer();
    $res = $data->signUp($args->getValue('pseudo'), $args->getValue('password'));
    //echo count($res);
    if ($res) {
      produceResult($res);
    } else {
      produceError("Cet utilisateur existe déja, utilisez un autre identifiant");
    }
  } catch (PDOException $e) {
    produceError($e->getMessage());
  } else
  produceError(implode(' ', $args->getErrorMessages()));
