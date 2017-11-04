<?php

/**
 * Retira todas as letras acentuadas
 */
function filename($filename) {
  $patterns[0] = '/[áàâãä]/';
  $patterns[1] = '/[ç]/';
  $patterns[2] = '/[èéêë]/';
  $patterns[3] = '/[íìîï]/';
  $patterns[4] = '/[óòõôö]/';
  $patterns[5] = '/[úùûü]/';
  $replacements[0] = 'a';
  $replacements[1] = 'c';
  $replacements[2] = 'e';
  $replacements[3] = 'i';
  $replacements[4] = 'o';
  $replacements[5] = 'u';

  return preg_replace($patterns,$replacements,strtolower($filename));
}

?>
