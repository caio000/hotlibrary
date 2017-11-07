hotlibrary.controller('BookEdit',function ($scope,$document,$filter,bookAPI,book,authors,publishingCompanies,categories) {

  var init = function () {
    $scope.isEdit = true;
    $scope.Page = {title:'Hotlibrary - Editar livro'};
    $document.find("#cover").fileinput({
      'showUpload':false,
      'language':'pt-BR',
      'browseClass':'btn btn-hotlibrary',
      'msgPlaceholder': 'Selecione o {files}'
    });
    $scope.book = book.data;
    $scope.book.pages = parseInt(book.data.pages);
    $scope.book.edition = parseInt(book.data.edition);
    $scope.book.publishDate = $filter('date')(book.data.publishDate,'dd/MM/yyyy');
    $scope.authors = _setFilter(_preSelectedField($scope.book.authors,authors.data));
    $scope.publishingCompanies = _setFilter(_preSelectedField([$scope.book.publishingCompany],publishingCompanies.data));
    $scope.categories = _setFilter(_preSelectedField($scope.book.categories,categories.data));
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
    $scope.edit = _edit;
  }

  var _edit = function (book) {
    // verifica se o formulário está válido
    if ($scope.bookForm.$valid) {
      $scope.registration = true;

      // atualiza os dados do livro
      bookAPI.edit(book).then(function (){
        $scope.registration = false;
      },function () {
        $scope.registration = false;
      });
    }
  }

  // Busca o filtro "name" para ser aplicado em uma lista
  var _setFilter = function (authors) {
    authors.forEach(function(author){
      author.name = $filter('name')(author.name);
    });
    return authors;
  }

  var _preSelectedField = function (myElements,fieldElements) {
    // gera um array com os id's dos elementos
    var indexes = myElements.map(function(element){
      return element.id;
    });

    indexes.forEach(function(index){
      fieldElements.forEach(function(element) {
        if (element.id === index) element.isSelected = true;
      });
    });

    return fieldElements;
  }

  init();

});
