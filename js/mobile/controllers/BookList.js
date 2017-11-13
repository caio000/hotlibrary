hotlibrary.controller('mBookList',function ($scope,$location,books) {


  var init = function () {
      $scope.books = _setAuthorsToString(books.data);
      $scope.bookDetails = _bookDetails;
  }

  var _bookDetails = function (id) {
    var url = "/mobile/livro/detalhe/" + id;
    $location.path(url);
  }

  var _setAuthorsToString = function (books) {
    books.forEach(function (book) {
      book.authosString = _authorsToString(book.authors);
    });
    return books;
  }

  var _authorsToString = function (authors) {
    authors = authors.map(function (author){
      return author.name
    });
    return authors.toString();
  }

  init();
});
