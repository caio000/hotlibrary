hotlibrary.factory('Auth',function ($http, Application, $base64, $cookies, $rootScope) {

  var service = {};

  var _login = function (User, callback) {
    _validate(User).then(function success (response) {
      callback(response.data);
    });
  }

  var _validate = function (User) {
    return $http.post(Application.baseURL + 'Login/administration',User);
  }

  var _setCredentials = function (User) {
    // Gera um token para sessão do usuário
    var authData = $base64.encode( User.id + ':' + User.email + ':' + User.password );
    User.authData = authData;

    $rootScope.globals = {currentUser: User};
    // Adiciona o token no HEADER de todas as requisições realizadas pelo sistema.
    $http.defaults.headers.common.Authorization = 'basic ' + authData;
    // Adiciona o usuário no cookie.
    $cookies.putObject('globals', $rootScope.globals);
  }

  /**
   * Verifica a permissão de acesso a rota.
   * Ao receber os dados da rota é verificado se é necessário um autenticação.
   * Caso não seja necessário, é retornado TRUE.
   * @author Caio de Freitas
   * @param objeto com os dados da view
   * @return retorna um boolean true caso a view possa ser visualizada.
   */
  var _checkAuthForView = function (view) {
    var result = (!view.requiresAuthentication) ? true : _userHasAuthForView(view);
    return result;
  }

  var _userHasAuthForView = function(view) {
    return (!$rootScope.globals.currentUser) ? false : true;
  }

  var _userHasPermissionForView = function (view) {
    var user = $rootScope.globals.currentUser;
    var hasPermission = false;

    if (view.permissions) {
      view.permissions.forEach(function (permission) {
        if (user.level == permission){
          hasPermission = true;
          return;
        }
      });
    } else {
      hasPermission = true;
    }

    return hasPermission;
  }

  service.login = _login;
  service.setCredentials = _setCredentials;
  service.checkAuthForView = _checkAuthForView;
  service.userHasPermissionForView = _userHasPermissionForView;

  return service;
});
