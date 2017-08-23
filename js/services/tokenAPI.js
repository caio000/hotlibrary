hotlibrary.factory('tokenAPI',function ($http, Application) {

  var _checkToken = function (token) {
    $http.get(Application.baseURL + 'valida/token/' + token);
  }

  return {
    checkToken: _checkToken
  };
});
