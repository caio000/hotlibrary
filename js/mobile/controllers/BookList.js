hotlibrary.controller('mBookList',function ($scope,books) {


  var init = function () {
      $scope.books = _setAuthorsToString(books.data);
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
