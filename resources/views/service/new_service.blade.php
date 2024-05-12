@extends('layout/template')
@section('title')
    Récupération du mot de passe
@endsection

@section('content')
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <p class="col-3 offset-9">
            <a href="/service" class="col-12 text-primary">Liste des départements</a>
        </p>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Créer un service</h2>
                <hr>
                <form action="/service" class="col-12" method="POST">
                    @csrf
                    <div class="col-6 offset-3">
                            <input type="text" hidden name="admin_id" value="ADM0001" >
                            <div class="input-group mb-3 col-12 ">
                                <span class="input-group-text col-3 text-white text-center input-login" id="">Nom</span>
                                <input type="text" name="service_name" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                    placeholder="Entrer le nom du service">
                            </div>
                            @error('service_name')
                                <div class="col-12 alert alert-danger text-center">{{ $message }}</div>
                            @enderror
                            <div class="input-group mb-3 col-12  " >
                                <span class="input-group-text text-white col-3 input-login" id="">Localisation </span>
                                <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                                    placeholder="Entrer la localisation" name="service_location">
                            </div>
                            @error('location')
                                <div class="col-12 alert alert-danger text-center">{{ $message }}</div>
                            @enderror
                            <div class="input-group mb-3 col-12 ">
                                <span class="input-group-text  input-login text-white col-5">Téléphone de service</span>
                                <input type="tel" name="telephone" id="" class="form-control input-login">
                            </div>
                            @error('telephone')
                                <div class="col-12 alert alert-danger text-center">{{ $message }}</div>
                            @enderror
                            <div class="input-group mb-3 col-12 ">
                                <span class="input-group-text  input-login text-white col-5">Service email</span>
                                <input type="email" name="email_service" id="" class="form-control input-login"
                                    placeholder="service@amtcm-sa.com">
                            </div>
                            @error('email')
                                <div class="col-12 alert alert-danger text-center">{{ $message }}</div>
                            @enderror
                            <div class="input-group mb-3 col-12 ">
                                <select name="department_id" id="department_id" class="form-control input-login">
                                    <option value="" selected disabled>Sélectionner son département</option>
                                    @foreach ($department as $item)
                                        <option value="{{ $item->department_id}}">{{ $item->department_name }} </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('department_id')
                            <div class="col-12 alert alert-danger text-center">{{ $message }}</div>
                        @enderror
                            <div class="input-group mb-3">
                                <input type="submit" class="btn-login col-8 offset-2" value="Enregistrer">
                            </div>

                    </div>
                </form>
    </main>
@endsection

@extends('layout/header')
@extends('layout/menu')