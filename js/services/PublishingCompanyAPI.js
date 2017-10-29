hotlibrary.factory('publishingCompanyAPI', function($http,Application) {

  var _save = function (publishCompany) {
    return $http.post(Application.baseURL + 'editora/cadastrar', publishCompany);
  }

  var _delete = function (id) {
    return $http.delete(Application.baseURL + 'editora/deletar/' + id);
  }

  var _getAll = function () {
    return $http.get(Application.baseURL + 'editora/todos');
  }

  return  {
    delete: _delete,
    save: _save,
    getAll: _getAll,
  }
})
