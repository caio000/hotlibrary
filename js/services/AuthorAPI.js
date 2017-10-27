hotlibrary.factory('authorAPI', function($http,Application) {

  var _save = function (author) {
    return $http.post(Application.baseURL + 'autor/cadastrar',author);
  }

  var _getAll = function () {
    return $http.get(Application.baseURL + 'autores/todos');
  }

  return {
    getAll: _getAll,
    save: _save,
  }
})
