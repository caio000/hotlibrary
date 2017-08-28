var hotlibrary = angular.module('hotlibrary',['ngRoute','base64','ngCookies','ngMessages']);

hotlibrary.run(function ($rootScope, $cookies, $http, $location, Auth, $route) {
  // Pega os dados do usuário no cookie caso exista, caso contrario é atribuido
  // um objeto vazio.
  $rootScope.globals = $cookies.getObject('globals') || {};
  // Verifica se existe um usuário na sessão
  if ($rootScope.globals.currentUser)
    $http.defaults.headers.common.Authorization = 'Basic ' + $rootScope.globals.currentUser.authData;

  // Essa função é chamada em toda transição de view
  $rootScope.$on('$routeChangeStart', function (event, next, current) {
    var theme = ( $location.path() == '/' ) ? 'bg-dark' : 'bg-white';
    $rootScope.globals.Page = {background: theme};

    if (!Auth.checkAuthForView(next))
      $location.path('/');
    else if (!Auth.userHasPermissionForView(next))
      $location.path('/erro/acesso_negado');
  });

});
