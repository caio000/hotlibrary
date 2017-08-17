hotlibrary.directive('ngExistEmail', function (UserAPI,$q) {
  return {
    require: 'ngModel',
    link: function (scope, element, attrs, ctrl) {
      element.on('keyup',function () {
        ctrl.$asyncValidators.emailAsync = function (modelValue, viewValue) {
          return UserAPI.existEmail(viewValue).then(function success (response) {
            if (response.data.result){
              console.log('email existe');
              return $q.resolve();
            } else {
              console.log('email não existe');
              return $q.reject();
            }
          });
        };
      });
    }
  };
});
