hotlibrary.factory('Auth',function ($http, Application) {

  var service = {};

  var _login = function (User, callback) {
    _validate(User).then(function success (response) {
      callback(response.data);
    });
  }

  var _validate = function (User) {
    return $http.post(Application.baseURL + 'User/validate',User);
  }

  service.login = _login;

  return service;
});
