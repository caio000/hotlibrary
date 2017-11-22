<?php

/**
 * Retira todas as letras acentuadas
 */
function filename($filename) {
  $ext = pathinfo($filename, PATHINFO_EXTENSION); // pega a extensão do arquivo

  $patterns[0] = '/[áàâãä]/';
  $patterns[1] = '/[ç]/';
  $patterns[2] = '/[èéêë]/';
  $patterns[3] = '/[íìîï]/';
  $patterns[4] = '/[óòõôö]/';
  $patterns[5] = '/[úùûü]/';
  $patterns[6] = '/[.,-_]/';
  $patterns[7] = '/jpg|png|jpeg| /';
  $replacements[0] = 'a';
  $replacements[1] = 'c';
  $replacements[2] = 'e';
  $replacements[3] = 'i';
  $replacements[4] = 'o';
  $replacements[5] = 'u';
  $replacements[6] = '';
  $replacements[7] = '';

  return preg_replace($patterns,$replacements,strtolower($filename)) . '.' . $ext;
}

?>
