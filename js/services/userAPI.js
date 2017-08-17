hotlibrary.factory('UserAPI', function ($http, Application, $base64) {

  var _saveUser = function (User) {
    return $http.post(Application.baseURL + 'User/saveUser', User);
  }

  var _forgotPassword = function (User) {
    return $http.post(Application.baseURL + 'usuario/esqueceu/senha/',User.email);
  }

  var _existEmail = function (email) {
    return $http.post(Application.baseURL + 'usuario/existe/email', email);
  }

  return {
    saveUser: _saveUser,
    forgotPassword: _forgotPassword,
    existEmail: _existEmail
  };
});
