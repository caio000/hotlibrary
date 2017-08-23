hotlibrary.factory('error',function ($q, $location) {
  return {
    responseError: function (rejection) {

      switch(rejection.status) {
        case 401:
          $location.path('/erro/acesso_negado');
          break;
      }

      return $q.reject(rejection);
    }
  };
});
