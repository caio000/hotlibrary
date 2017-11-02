hotlibrary.controller('BookRegistration',function ($scope,$document,authors,publishingCompanies,categories,bookAPI,$filter) {

  var init = function () {
    $document.find("#cover").fileinput({
      'showUpload':false,
      'language':'pt-BR',
      'browseClass':'btn btn-hotlibrary',
      'msgPlaceholder': 'Selecione o {files}'
    });
    $scope.isEdit = false;
    $scope.Page = {title: 'Hotlibrary - Cadastrar livro'};
    $scope.register = register;
    $scope.authors = _setFilter(authors.data);
    $scope.publishingCompanies = _setFilter(publishingCompanies.data);
    $scope.categories = _setFilter(categories.data);
    $scope.translation = {
      author: {
        selectAll:'Marcar todos',
        selectNone:'Desmarcar todos',
        reset: 'Reiniciar',
        search:'Busque os(as) autores(as)',
        nothingSelected:'Selecione os(as) autores(as)',
      },
      publishingCompany: {
        selectAll:'Marcar todos',
        selectNone:'Desmarcar todos',
        reset: 'Reiniciar',
        search:'Busque as editoras',
        nothingSelected:'Selecione a editora',
      },
      category: {
        selectAll:'Marcar todos',
        selectNone:'Desmarcar todos',
        reset: 'Reiniciar',
        search:'Busque as categorias',
        nothingSelected:'Selecione a categoria',
      }
    };
  }

  // Busca o filtro "name" para ser aplicado em uma lista
  var _setFilter = function (authors) {
    authors.forEach(function(author){
      author.name = $filter('name')(author.name);
    });
    return authors;
  }

  // envia os dados para o cadastro do livro
  var register = function (book) {

    if ($scope.bookForm.$valid) {
      var formData = new FormData();
      var file = book.cover[0];
      formData.append('cover',file);
      book.cover = file.name;

      // envia os dados do livro para serem salvos
      bookAPI.save(book).then(
        function success (response) {
          if (response.data.result) {
            if (file) {
              // Faz o upload da imagem
              bookAPI.saveCover(formData).then(function success (response) {
                var msg = (response.data.result) ? 'Livro cadastrado com sucesso' : 'Livro cadastrado, porém não foi possivel carregar a imagem';
                config = {type:'success',msg:msg};
                $scope.$emit('alert',config);
              });
            } else {
              $scope.$emit('alert',{type:'success',msg:'Livro cadastrado com sucesso'});
            }
            book.cover = {"0":file};
          } else {
            book.cover = {"0":file};
            $scope.$emit('alert',{type:'danger',title:'Ops!',msg:'Ocorreu um erro ao cadastrar um livro'});
          }

      }, function error () {
        book.cover = {"0":file};
        $scope.$emit('alert',{type:'warning',title:'Ops!',msg:'Problemas para se conectar ao servidor, tente novamente mais tarde'});
      });
    }
  }

  init();
});
