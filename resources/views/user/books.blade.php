@extends('layout.appShopping')
@section('content')
    @if (Session::get('bookAdded'))
        <div class="alert alert-success">
            {{ Session::get('bookAdded') }}
        </div>
    @endif
    @if (Session::get('bookNotAdded'))
        <div class="alert alert-danger">
            {{ Session::get('bookNotAdded') }}
        </div>
    @endif
    <div id="listeLivre" class="container">
        <a href="javascript:" id="return-to-top"><i class="fas fa-chevron-up"></i></a>
            @foreach ($allBook as $book)
                <div class="row shadow my-3">
                    <div class="text-center py-4 col-3">
                        <img class="img-fluid" src="{{ asset('img/' . $book->photo) }}"
                            alt="{{ $book->titre }}.photo" srcset="">
                    </div>
                    <div class="col d-flex flex-column justify-content-center mt-2">
                        <h4>{{ $book->titre }}</h4>
                        <cite>de <b>{{ $book->auteur }}</b></cite>
                            ${{ $book->prix }}
                @if ($book->quantite > 0)
                        <div class="font-weight-bold">In stock</div>
                    </div>
                    <div class="col-3 d-flex align-items-end align-items-center">
                        <a id="addToCart" href="/shopping/add/{{ $book->isbn }}" class="btn btn-dark shadow">Ajouter au panier</a>
                    </div>
                </div>
                @else
                        <div id="outOfStock" class="font-weight-bold">Out of stock</div>
                    </div>
                    <div class="col-3 d-flex align-items-end align-items-center">
                        <a id="addToCart" class="btn btn-light disabled shadow">Out of stock</a></div>
                    </div>
                    @endif

            @endforeach
    </div>

@endsection
