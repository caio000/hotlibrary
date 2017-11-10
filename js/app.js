var hotlibrary = angular.module('hotlibrary',['ngRoute','base64','ngCookies','ngMessages','angular.viacep','angularUtils.directives.dirPagination','isteven-multi-select']);

hotlibrary.run(function ($rootScope, $cookies, $http, $location, Auth, $route) {

  var isMobile = navigator.userAgent.match(/(iPhone|iPod|iPad|Android|BlackBerry)/);
  if (isMobile && !$location.path().match(/mobile/g)) {
    $location.path('/mobile');
  }

  // Pega os dados do usuário no cookie caso exista, caso contrario é atribuido
  // um objeto vazio.
  $rootScope.globals = $cookies.getObject('globals') || {};
  // Verifica se existe um usuário na sessão
  if ($rootScope.globals.currentUser)
    $http.defaults.headers.common.Authorization = 'Basic ' + $rootScope.globals.currentUser.authData;

  // Essa função é chamada em toda transição de view
  $rootScope.$on('$routeChangeStart', function (event, next, current) {
    var theme = ( $location.path() == '/' ) ? 'bg-dark' : '';
    $rootScope.globals.Page = {background: theme};
    $rootScope.globals.Page.showMenu = next.hasMenu;

    if (!Auth.checkAuthForView(next))
      $location.path('/');
    else if (!Auth.userHasPermissionForView(next))
      $location.path('/erro/acesso_negado');
  });

});
