<?php

function getToken () {

  $CI = get_instance();

  // Pega o token no cabeçalho da requisição
  $token = $CI->input->get_request_header('Authorization');
  $token = str_replace(array('basic',' '),'', $token);
  $token = base64_decode($token);
  $token = explode(':',$token);

  return $token;
}

?>
