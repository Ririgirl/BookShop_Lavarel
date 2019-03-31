<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Панель администратора</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<style>
    body {
  overflow-x: hidden;
}

#sidebar-wrapper {
  min-height: 100vh;
  margin-left: -15rem;
  -webkit-transition: margin .25s ease-out;
  -moz-transition: margin .25s ease-out;
  -o-transition: margin .25s ease-out;
  transition: margin .25s ease-out;
}

#sidebar-wrapper .sidebar-heading {
  padding: 0.875rem 1.25rem;
  font-size: 1.2rem;
}

#sidebar-wrapper .list-group {
  width: 15rem;
}

#page-content-wrapper {
  min-width: 100vw;
}

#wrapper.toggled #sidebar-wrapper {
  margin-left: 0;
}

@media (min-width: 768px) {
  #sidebar-wrapper {
    margin-left: 0;
  }

  #page-content-wrapper {
    min-width: 0;
    width: 100%;
  }

  #wrapper.toggled #sidebar-wrapper {
    margin-left: -15rem;
  }
}
</style>
<body>
        <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Администратор</div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light disabled">Список книг</a>
        <a href="{{ action('AdminController@orders') }}" class="list-group-item list-group-item-action bg-light">Список заказов</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button type="button" class="btn btn-light">
          <span class="navbar-toggler-icon" id="menu-toggle"></span>
        </button>


        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        {{ __('Выход') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
      </nav>

      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6"><h1 class="mt-4">Список книг</h1></div>
            <div class="col-md-6"><br><a class="btn btn-success float-right" href="{{ action('AdminController@newbook') }}" role="button">Добавить новую книгу</a>
        </div>
         
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Название</th>
              <th scope="col">Автор</th>
              <th scope="col">Год</th>
              <th scope="col">Цена<br>(руб)</th>
              <th scope="col">Изменить</th>
              <th scope="col">Удалить</th>
            </tr>
          </thead>
          <tbody>
            @FOREACH ($books as $book)
                <tr>
                  <th scope="row">{{ $loop->iteration }} {{-- Starts with 1 --}}</th>
                  <td>{{ $book->name_book }}</td>
                  <td>{{ $book->fname }} {{ $book->name }} {{ $book->oname }}</td>
                  <td>{{ $book->year }}</td>
                  <td>{{ $book->price }}</td>
                  <td><a class="btn btn-info" href="{{ action('AdminController@updatebook', $book->id ) }}">Изменить</a></td>
                  <td>
                    <form action = "{{ action('AdminController@deletebook', $book->id ) }}" method = "post" class='delete_form'>
                      {{ csrf_field() }}
                      <input type="hidden" method='_method' value='DELETE'/>
                      <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                  </td>
                </tr>
            @endFOREACH
          </tbody>
        </table>
        
      </div>
      <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

                @if($books->currentPage() == 1)
                    <li class="page-item disabled">
                        <a class="page-link" href="{{ $books->previousPageUrl() }}" tabindex="-1">Предидущая</a>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $books->previousPageUrl() }}" tabindex="-1">Предидущая</a>
                    </li>
                @endif

                <li class="page-item"><a class="page-link" href="{{ $books->url(1) }}">1</a></li>
                <li class="page-item disabled"><p class="page-link">Вы на странице {{$books->currentPage()}}</p></li>
                <li class="page-item"><a class="page-link" href="{{ 'admin/?page='.$books->lastPage() }}">{{ $books->lastPage() }}</a></li>

                @if($books->hasMorePages())
                        <li class="page-item"><a class="page-link" href="{{ $books->nextPageUrl() }}">Следующая</a>
                    @else
                        <li class="page-item disabled"><a class="page-link" href="{{ $books->nextPageUrl() }}">Следующая</a>
                @endif

                </li>
            </ul>
        </nav>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
 <script>
                    $(document).ready(function(){
                      $('.delete_form').on('submit', function(){
                        if (confirm('Вы действительно хотите удалить запись?'))
                        {
                          return true;
                        }
                        else
                        {
                          return false;
                        }
                      });
                    });
                  </script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    $('.dropdown').click(function(){

       $('.dropdown-menu').toggleClass('show');

   });
  </script>
</body>
</html>
