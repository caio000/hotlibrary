hotlibrary.filter('name', function() {
  return function (input) {
    if (!input) { return input; }
    input = input.toLowerCase();
    var name = input.split(" ");

    input = name.map(function(subName){
      var subName = subName.charAt(0).toUpperCase() + subName.substring(1).toLowerCase();
      return subName;
    });

    return input.join(" ");
  };
})
