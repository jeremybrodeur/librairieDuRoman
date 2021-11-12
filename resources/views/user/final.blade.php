@extends('layout.appShopping')
@section('content')
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col-12">
            <div class="card bg-light my-3">
                <h4 class="card-header text-center font-weight-bold">Confirmation de commande!</h4>
                <div class="card-body">
                    <h6 class="card-title">Commande pour {{ $user->name }}:</h6>
                    <span>Rammassage le: {{ $facture->pickUpDate }}</span><br>
                    <span>Sous-total de: ${{ $facture->total }}</span><br>
                    @php
                        $taxeTotal = number_format($facture->total * $taxe, 2);
                        $sousTotal = floatval($facture->total * $taxe + $facture->total);
                        $formatted = number_format($sousTotal, 2);
                    @endphp
                    <span>Taxe: ${{ $taxeTotal }}</span><br>
                    <span>Total de: ${{ $formatted }}</span><br><hr>
                    <cite>Merci pour votre commande!</cite>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
