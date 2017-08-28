hotlibrary.factory('tokenAPI',function ($http, Application) {

  var _checkToken = function (token) {
    return $http.get(Application.baseURL + 'valida/token/' + token);
  }

  return {
    checkToken: _checkToken
  };
});
