hotlibrary.directive("compareTo", function () {
  return {
    restrict: "A",
    require: 'ngModel',
    link: function (scope, element, attrs, ctrl) {
      var passwordField = '#' + attrs.compareTo;

      element.add(password).on('keyup',function () {
        scope.$apply(function () {
          var v = element.val() === $(passwordField).val();
          ctrl.$setValidity('pwmatch',v);
        });
      })

    },
  };
});
