hotlibrary.filter('firstToUpper',function () {
  return function (input) {
    input.toLowerCase();
    input.charAt(0).toUpperCase();
    input = input.charAt(0).toUpperCase() + input.substring(1).toLowerCase();
    return input;
  }
});
