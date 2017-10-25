hotlibrary.factory('categoryAPI', function($http,Application) {

  var _save = function (category) {
    return $http.post(Application.baseURL + 'categoria/cadastrar', category);
  }

  return {
    save: _save,
  }
})
