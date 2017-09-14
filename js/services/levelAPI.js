hotlibrary.factory('levelAPI',function ($http, Application) {

  var _getAll = function () {
    return $http.get(Application.baseURL + 'nivel/todos');
  }

  var services = {
    getAll: _getAll
  };

  return services;

});
