hotlibrary.factory('libraryAPI',function ($http,Application) {

  var _getAll = function (id) {
    return $http.get(Application.baseURL + 'biblioteca/' + id);
  }

  var _addBook = function (data) {
    return $http.post(Application.baseURL + 'biblioteca/adicionar/livros',data);
  }

  var _deleteBook = function (id) {
    return $http.delete(Application.baseURL + 'biblioteca/deletar/livro/'+id);
  }

  var _getNotification = function (id){
    return $http.get(Application.baseURL + "biblioteca/notificacoes/" + id);
  }
  return {
    getAll: _getAll,
    addBook: _addBook,
    deleteBook: _deleteBook,
    getNotification: _getNotification,
  };
})
