hotlibrary.factory('categoryAPI', function($http,Application) {

  var _save = function (category) {
    return $http.post(Application.baseURL + 'categoria/cadastrar', category);
  }

  var _getAll = function () {
    return $http.get(Application.baseURL + 'categoria/todos');
  }

  return {
    save: _save,
    getAll: _getAll,
  }
})
