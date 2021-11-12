@extends('layout.appShopping')
@section('content')
    @if (Session::get('logToCheckout'))
        <div class="alert alert-danger">
            {{ Session::get('logToCheckout') }}
        </div>
    @endif
    @if (Session::get('cartIsEmpty'))
        <div class="alert alert-danger">
            {{ Session::get('cartIsEmpty') }}
        </div>
    @endif
    <div id="listeLivre" class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-3 mt-5">
                <h4>Votre panier: </h4><br>
                <?php $total = 0; ?>
                @if (Session::has('cart'))
                    <table id="tableLivre" class="table table-hover">
                        <tbody>

                            @foreach (Session::get('cart') as $isbn => $details)
                                <?php $total += $details['prix'] * $details['quantityInCart']; ?>
                                <tr>
                                    <td>
                                        <img class="img-responsive" width="200" height="200"
                                            src="{{ asset('img/' . $details['photo']) }}" alt="couverture">
                                    </td>
                                    <td class="text-center">
                                        {{ $details['titre'] }} <br>par <b>{{ $details['auteur'] }}</b>
                                    </td>
                                    <td class="text-center">
                                        {{ $details['quantityInCart'] }}
                                    </td>
                                    <td class="text-center">
                                        <b>${{ $details['prix'] * $details['quantityInCart'] }}</b>
                                    </td>
                                    <td class="text-center">
                                        <a href="/shopping/delete/{{ $isbn }}"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <hr>
                    <div class="d-flex justify-content-end">
                        <div>Total: <span class="font-weight-bold">${{ $total }}</span></div>
                        {{ Session::put('total', $total) }}
                    </div>
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-dark col shadow mr-2 mt-5" href="/shopping/checkout">Checkout</a>
                        <a class="btn btn-light col shadow mt-5" href="/shopping/emptyCart">Vider le panier</a>
                    </div>
                @else
                    <h6>Votre panier est vide! <a href="/shopping/books">Ajouter des livres</a></h6>
                @endif
                
            </div>
        </div>
        
    </div>
@endsection
