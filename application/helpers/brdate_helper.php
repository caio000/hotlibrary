<?php

/**
 * Converte uma data do formato BR para SQL.
 * @author Caio de Freitas Adriano.
 * @param String - data em formado BR
 * @return String - Retorna a data no formato SQL.
 */
function brToSqlDate($date) {
  $date = explode('/',$date);
  return $date[2] . '-' . $date[1] . '-' . $date[0];
}


?>
