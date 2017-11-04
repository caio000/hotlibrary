<?php
function createLog ($idUser, $message) {

  $CI = get_instance();

  date_default_timezone_set('America/Sao_Paulo');

  $log['ip'] = $CI->input->ip_address();
  $log['message'] = $message;
  $log['date'] = Date('Y-m-d');
  $log['time'] = Date('h:i:s');
  $log['idUser'] = $idUser;

  return $log;
}

?>
