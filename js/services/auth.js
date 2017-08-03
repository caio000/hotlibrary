hotlibrary.factory('Auth',function ($http, Application, $base64, $cookies, $rootScope) {

  var service = {};

  var _login = function (User, callback) {
    _validate(User).then(function success (response) {
      callback(response.data);
    });
  }

  var _validate = function (User) {
    return $http.post(Application.baseURL + 'User/validate',User);
  }

  var _setCredentials = function (User) {
    // Gera um token para sessão do usuário
    var authData = $base64.encode( User.email + ':' + User.password );
    User.authData = authData;

    $rootScope.globals = {currentUser: User};
    // Adiciona o token no HEADER de todas as requisições realizadas pelo sistema.
    $http.defaults.headers.common.Authorization = 'basic ' + authData;
    // Adiciona o usuário no cookie.
    $cookies.putObject('globals', $rootScope.globals);
  }

  service.login = _login;
  service.setCredentials = _setCredentials;

  return service;
});
