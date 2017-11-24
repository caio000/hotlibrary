hotlibrary.controller('Library',function ($scope,$document,$filter,books,library,UserAPI,libraryAPI) {

  var init = function () {
    $scope.library = library.data;
    $scope.books = _setFilterName(books.data);
    $scope.Page = {title:$scope.library.name};
    $scope.alterPassword = _alterPassword;
    $scope.translation = {
      selectAll:'Marcar todos',
      selectNone:'Desmarcar todos',
      reset: 'Reiniciar',
      search:'Busque os livros',
      nothingSelected:'Selecione os livros',
    }
    $scope.addBook = _addBook;
  }

  var _alterPassword = function (password,form) {
    if (form.$valid) {

      $scope.library.password = password;
      UserAPI.alterPassword($scope.library).then(
        function success (response) {
          $scope.library = response.data.user;
          $document.find("#hotModal").modal('hide');
          $scope.$emit('alert',{type:'success',msg:'Senha alterada'});
        }, function error () {
          $document.find("#hotModal").modal('hide');
          $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
        });

    }
  }

  var _addBook = function (books) {
    if (books.length >= 1) {
      $scope.disabled = true;

      libraryAPI.addBook({library:$scope.library,books:books}).then(
        function success (response) {

          if (response.data.result) {
            msg = (books.length > 1) ? 'Livros adicionados com sucesso' : 'Livro adicionado com sucesso';
            config = {type:'success',msg:msg};
            // adiciona os novos livros a biblioteca
            books.forEach(function (book) {
              $scope.library.books.push(book);
            });

            // limpa o multiselect
            $scope.books.forEach(function (book) {
              book.isSelected = false;
            });

          } else {
            config = {type:'danger',title:'Ops',msg:'Ocorreu um problema para adicionar o livro'};
          }


          $scope.$emit('alert',config)
          $scope.disabled = false;
        }, function error (response) {
          $scope.$emit('alert',{type:'warning',title:'Ops',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
          $scope.disabled = false;
        });


    }
  }

  var _setFilterName = function (array) {
    array.forEach(function(key){
      key.name = $filter('name')(key.name);
    });
    return array;
  }

  init();

});
