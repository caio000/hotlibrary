hotlibrary.factory('libraryAPI',function ($http,Application) {

  var _getAll = function (id) {
    return $http.get(Application.baseURL + 'biblioteca/' + id);
  }

  var _addBook = function (data) {
    return $http.post(Application.baseURL + 'biblioteca/adicionar/livros',data);
  }


  return {
    getAll: _getAll,
    addBook: _addBook,
  };
})
