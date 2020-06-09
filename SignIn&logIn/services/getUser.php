<?php
set_include_path('..'.PATH_SEPARATOR);

require_once('lib/common_service.php');
require_once('lib/session_start.php');

$args = new RequestParameters();
$args->defineNonEmptyString('pseudo');

if ($args->isValid())
    try{
      $data = new DataLayer();
      $res = $data->getUser($args->getValue('pseudo'));
      if ($res) {
        produceResult($res);
      }
      else {
        produceError("Cet utilisateur n'existe pas");
      }
    } catch (PDOException $e){
        produceError($e->getMessage());
    }
else
    produceError(implode(' ',$args->getErrorMessages()));

?>
