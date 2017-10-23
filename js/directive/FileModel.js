hotlibrary.directive('fileModel',function ($parse) {
  return {
    restrict: "A",
    link: function (scope, element, attrs) {
      var model = $parse(attrs.fileModel);
      var modelSetter = model.assign;

      console.log(element.find('#cover'));

      element.bind('change', function(){
        scope.$apply(function(){
          modelSetter(scope, element.find('#cover')[0].files[0]);
        });
      });
    }
  };
})
