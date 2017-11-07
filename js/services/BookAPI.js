hotlibrary.factory('bookAPI', function($http,Application) {

  var _saveCover = function (cover) {
    return $http.post(Application.baseURL + 'livro/upload/capa',cover,{
         transformRequest: angular.identity,
         headers: {'Content-Type': undefined,'Process-Data': false}
    });
  }

  var _save = function (book) {
    return $http.post(Application.baseURL + 'livro/cadastrar',book);
  }

  var _edit = function (book) {
    return $http.patch(Application.baseURL + 'livro/editar',book);
  }

  var _getAll = function (params) {
    return $http.get(Application.baseURL + 'livro/todos',params);
  }

  var _getById = function (id) {
    return $http.get(Application.baseURL + 'livro/'+ id);
  }

  var _delete = function (id) {
    return $http.delete(Application.baseURL + 'livro/deletar/'+id);
  }

  return {
    save: _save,
    edit: _edit,
    getAll: _getAll,
    getById: _getById,
    saveCover: _saveCover,
    delete: _delete,
  }
})
