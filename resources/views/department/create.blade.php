@extends('layout/template')
@section('title')
    Création des départements
@endsection

@section('content')
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <p class="col-3 offset-9">
            <a href="/department" class="col-12 text-primary">Liste des départements</a>
        </p>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Créer un département</h2>
            <hr>
            <form action="/department" class="col-12" method="POST">
                @csrf
                <div class="col-6 offset-3">
                        <div class="input-group mb-3 col-12 ">
                            <span class="input-group-text col-3 text-white text-center input-login" id="">Nom</span>
                            <input type="text" name="department_name" class="form-control input-login" aria-label="Sizing example input" 
                                aria-describedby="inputGroup-sizing-default" placeholder="Entrer le nom du département">
                        </div>
                        @error('department_name')
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