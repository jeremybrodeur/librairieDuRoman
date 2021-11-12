@extends('layout.appLogged')
@section('content')
    <div class="container">
        @if (Session::get('UserType') == 1)
            <div id="listeLivre" class="container">
                <div class="row">
                    <div class="col-md-12 col-md-offset-3 mt-5">
                        <table id="tableLivre" class="table table-hover">
                            <thead>
                                <th>ISBN</th>
                                <th>Auteur(e)</th>
                                <th>Titre</th>
                                <th>Quantite</th>
                                <th>Photo</th>
                                <th>Resume</th>
                            </thead>
                            <tbody>
                                @foreach ($allBook as $book)
                                    <tr>
                                        <td class="text-center">
                                            <a href="/admin/manageBook/{{ $book->isbn }}">
                                                {{ $book->isbn }}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            {{ $book->auteur }}
                                        </td>
                                        <td class="text-center">
                                            {{ $book->titre }}
                                        </td>
                                        <td class="text-center">
                                            {{ $book->quantite }}
                                        </td>
                                        <td class="text-center">
                                            <img src="{{ asset('img/' . $book->photo) }}" alt="{{ $book->titre }}.photo"
                                                srcset="">
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ asset('resume/' . $book->resume) }}"
                                                download="resumeLivre">Resume</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        @else

            @if (Session::get('LoggedUser') != null)
                {{ Session::put('failAccessAdmin', 'You are not authorized to access this page!') }}
                <script>
                    window.location = "/user/home"
                </script>
            @else
                {{ Session::put('failAccess', 'You need to be logged in to access this page!') }}
                <script>
                    window.location = "/auth/login"
                </script>
            @endif
        @endif
    </div>
@endsection
