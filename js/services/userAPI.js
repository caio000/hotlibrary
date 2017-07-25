hotlibrary.factory('UserAPI', function ($http, Application) {

  var _saveUser = function (User) {
    return $http.post(Application.baseURL + 'User/saveUser', User);
  }

  return {
    saveUser: _saveUser
  };
});
