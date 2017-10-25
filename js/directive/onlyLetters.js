hotlibrary.directive('onlyLetters',function() {
  return {
    restrict: 'A',
    require: 'ngModel',
    link: function (scope, element, attrs, ctrl) {

      var _removeNumbers = function (text) {
        text = text.replace(/[0-9]/g,'');
        return text;
      }

      element.bind('keyup',function () {
        scope.$apply(function () {
          var regex = /[0-9]/g;
          var text = ctrl.$viewValue;
          var result = regex.test(text);
          ctrl.$setValidity('onlyLetters',!result);
        });
      });
/*
      element.bind('blur',function() {
        var text = ctrl.$viewValue;
        ctrl.$setViewValue(_removeNumbers(text));
        ctrl.$render();
      });*/
    }
  }
});
