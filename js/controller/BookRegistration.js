hotlibrary.controller('BookRegistration',function ($scope,$document,authors,publishingCompanies,categories,$filter) {

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
    console.log(book);

    // TODO: Criar função para cadastrar livro
  }

  init();
});
