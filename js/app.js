var hotlibrary = angular.module('hotlibrary',['ngRoute','base64','ngCookies']);

hotlibrary.run(function ($rootScope, $cookies, $http, $location) {
  // Pega os dados do usuário no cookie caso exista, caso contrario é atribuido
  // um objeto vazio.
  $rootScope.globals = $cookies.getObject('globals') || {};
  // Verifica se existe um usuário na sessão
  if ($rootScope.globals.currentUser)
    $http.defaults.headers.common.Authorization = 'Basic ' + $rootScope.globals.currentUser.authData;

  // Essa função é chamada em toda transição de view
  $rootScope.$on('$locationChangeStart', function (event, next, current) {
    // Verifica se estamos em uma rota diferente da rota '/' (página de login) e
    //  se existe um usuário na sessão
    if ( $location.path() !== '/' && !$rootScope.globals.currentUser )
      $location.path('/');
    else if ( $location.path() === '/' && $rootScope.globals.currentUser )
      $location.path('usuario/cadastrar');
  });

});
