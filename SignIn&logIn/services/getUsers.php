<?php
set_include_path('..'.PATH_SEPARATOR);

require_once('lib/common_service.php');
require_once('lib/session_start.php');


try{
  $data = new DataLayer();
  $res = $data->getUsers();
  if ($res) {
    produceResult($res);
  }
  else {
    produceError("Aucun message sur le site");
  }
} catch (PDOException $e){
    produceError($e->getMessage());
}

?>
