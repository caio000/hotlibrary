hotlibrary.directive('getAddressByZipcode', function(viaCep) {

  return {
    restrict: "A",
    require: "ngModel",
    link: function (scope, element, attrs, ctrl) {

      element.on('blur', function () {
        scope.search = true;
        var zipcode = ctrl.$viewValue;
        
        viaCep.get(zipcode).then(function (response) {
          scope.User.Address.City.name = response.localidade;
          scope.User.Address.City.Neighborhood.name = response.bairro;
          scope.User.Address.City.State.initials = response.uf;
          scope.User.Address.publicPlace = response.logradouro;

          scope.search = false;
        }, function () {
          scope.zipcodeError = true;
          scope.search = false;
        });
      });
    }
  }
})
