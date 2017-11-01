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
    // TODO: colocar o url para o serviço de edição.
  }

  var _getAll = function () {
    // TODO: Colocar a url para o serviço para buscar todos os livros
  }

  var _getById = function () {
    // TODO: Colocar a url para o serviço de buscar um livro
  }

  return {
    save: _save,
    edit: _edit,
    getAll: _getAll,
    getById: _getById,
    saveCover: _saveCover
  }
})
