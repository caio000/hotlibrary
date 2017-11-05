hotlibrary.factory('libraryAPI',function ($http,Application) {

  var _getAll = function (id) {
    return $http.get(Application.baseURL + 'biblioteca/' + id);
  }


  return {
    getAll: _getAll
  };
})
