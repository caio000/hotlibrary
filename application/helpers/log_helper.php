<?php
function createLog ($idUser, $message) {

  // FIXME: Definir o fuso horario para o brasil.

  $CI = get_instance();

  $log['ip'] = $CI->input->ip_address();
  $log['message'] = $message;
  $log['date'] = Date('Y-m-d');
  $log['time'] = Date('h:i:s');
  $log['idUser'] = $idUser;

  return $log;
}

?>
