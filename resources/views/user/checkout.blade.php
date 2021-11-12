@extends('layout.appShopping')
@section('content')
    @if (Session::has('LoggedUser'))
        @if (Session::get('failCheckout'))
            <div class="alert alert-success">
                {{ Session::get('failCheckout') }}
            </div>
        @endif
        <div class="container mt-5">
            <h4 class="mt-4 mb-4">Remplissez les champs pour finaliser votre commande</h4>
            <form method="POST" action="/shopping/facture" id="formFacture" name="formFacture">
                @csrf
                <div class="form-group">
                    <label for="name">Date de ramassage</label>
                    <input class="form-control" type="date" name="pickUpDate" id="pickUpDate">
                    <span class="text-danger">@error('name'){{ $message }}@enderror</span>
                    </div>
                    <div class="form-group">
                        <label for="region">Taxe</label>
                        <select class="form-control" name="region" id="region">
                            <option value="Québec">Québec</option>
                            <option value="Ontario">Ontario</option>
                            <option value="Colombie-Britannique">Colombie-Britannique</option>
                            <option value="Île-du-Prince-Édouard">Île-du-Prince-Édouard</option>
                            <option value="Alberta">Alberta</option>
                            <option value="Manitoba">Manitoba</option>
                            <option value="Nouvelle-Écosse">Nouvelle-Écosse</option>
                            <option value="Saskatchewan">Saskatchewan</option>
                            <option value="Terre-Neuve-et-Labrador">Terre-Neuve-et-Labrador</option>
                            <option value="Nouveau-Brunswick">Nouveau-Brunswick</option>
                        </select>
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>

                        </div>
                        <input class="btn btn-dark shadow" type="submit" value="Create">
                    </form>
                @else

                    @if (Session::get('LoggedUser') != null)
                        {{ Session::put('failAccess', 'You need to be logged in to access this page!') }}
                        <script>
                            window.location = "/auth/login"
                        </script>
                    @endif
            @endif
            </div>
        @endsection
