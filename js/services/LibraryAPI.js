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

  var _confirmLoan = function (loan) {
    return $http.patch(Application.baseURL + "biblioteca/confirmar/emprestimo",loan);
  }

  var _cancelLoan = function (loan) {
    return $http.patch(Application.baseURL + 'biblioteca/cancelar/emprestimo',loan);
  }


  return {
    getAll: _getAll,
    addBook: _addBook,
    deleteBook: _deleteBook,
    getNotification: _getNotification,
    confirmLoan: _confirmLoan,
    cancelLoan:_cancelLoan,
  };
})
