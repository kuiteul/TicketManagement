@extends('layout/template')
@section('title')
    Création d'un utilisateur
@endsection

@section('content')
    
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <p class="col-2 offset-10">
            <a href="/users" class="col-12 text-primary">Liste des utilisateurs</a>
        </p>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Création d'utilisateur</h2>
        <hr>
        <!-- 
            |
            | Formulaire de création de ticket 
            |
        -->
        <form action="/users" class="col-12" method="POST">
            @csrf <!-- Clé de contrôle du formulaire -->
            @isset($error)
                <div class="col-12 alert alert-danger text-center">{{ $error }}</div>
            @endisset
            <div class="col-6 offset-3">
                    <!-- Zone de texte du prénom -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Prénom </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer le prénom" name="first_name">
                    </div>
                    @error('first_name')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone de texte du nom -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Nom </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer le nom" name="last_name">
                    </div>
                    @error('last_name')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone de texte de l'adresse email -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Email </span>
                        <input type="email" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer une adresse email" name="email">
                    </div>
                    @error('email')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                     <!-- Zone de texte de l'adresse email -->
                     <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Téléphone </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Numéro de téléphone (Optional)" name="telephone">
                    </div>
                    @error('telephone')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone de texte de la fonction -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Poste </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer le poste occupée" name="position">
                    </div>
                    @error('position')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone du service affecté -->
                    <div class="input-group mb-3 col-12">
                        <span class="input-group-text text-white col-4 input-login" id="">Service</span>
                        <select name="service_id" id="" class="form-control input-login">  
                            <option value="null" disabled selected>Sélectionner un service</option>
                          @foreach ($service as $item)
                              <option value="{{ $item->service_id }}">{{ $item->service_name }}</option>
                          @endforeach
                        </select>
                    </div>
                    @error('service_id')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text text-white col-4 input-login">Mot de passe</span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer le mot de passe" name="password">
                    </div>
                    @error('passwords')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <div class="input-group mb-3 col-12 ">
                        <select name="role" id="" class="form-control input-login ">  
                            <option value="" selected disabled>Sélectionner un rôle</option>
                            <option value="User">Utilisateur</option>
                            <option value="Auditor">Auditeur</option>
                            <option value="Admin">Administrateur</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <input type="submit" class="btn-login col-8 offset-2" value="Enregistrer">
                    </div>

            </div>
        </form>
    </main>

@endsection

@extends('layout/header')
@extends('layout/menu')