@extends('layout/template')
@section('title')
    Gestion des utilisateurs
@endsection

@section('content')
    
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <div class="border d-flex flex-end col-8 offset-4">
            <p class="col-4">
                <a href="/users" class="col-12 text-primary">Liste des utilisateurs</a>
            </p>
            @foreach ($user as $item)
            <form action="/users/{{ $item->user_id }}" class="col-4" method="POST">
                @csrf
                @method('DELETE')
                <div class="col-8">
                    <button class="btn input-login col-12 cursor">Supprimer</button>
                </div>
           
            </form>
            @endforeach
        </div>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">
            Informations complètes sur  
            @foreach ($user as $item)
                {{ $item->first_name }}
            @endforeach
        </h2>
        <hr>
        <!-- 
            |
            | Formulaire de création de ticket 
            |
        -->
        
        @foreach ($user as $item)
        <form action="/users/{{ $item->user_id }}" class="col-12" method="POST">
            @csrf <!-- Clé de contrôle du formulaire -->
            @method("PUT")
            @isset($error)
                <div class="col-12 alert alert-danger text-center">{{ $error }}</div>
            @endisset
            <div class="col-6 offset-3">
                    
                    <!-- Zone de texte du prénom -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Prénom </span>
                        <input type="text" id="first_name" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                           disabled placeholder="Entrer le prénom" name="first_name" value="{{ $item->first_name }}">
                    </div>
                    @error('first_name')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone de texte du nom -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Nom </span>
                        <input type="text" id="last_name" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        disabled placeholder="Entrer le nom" name="last_name" value="{{ $item->last_name }}">
                    </div>
                    @error('last_name')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone de texte de l'adresse email -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Email </span>
                        <input type="email" id="email" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        disabled placeholder="Entrer une adresse email" name="email" value="{{ $item->email }}">
                    </div>
                    @error('email')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone de texte de la fonction -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Poste </span>
                        <input type="text" id="title" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        disabled name="title" value="{{ $item->title }}">
                    </div>
                    @error('title')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone du service affecté -->
                    <div class="input-group mb-3 col-12"  id="service_name">
                        <span class="input-group-text col-4 text-white text-center input-login">Service</span>
                        @foreach ($user_service as $item_service)
                            <input type="text" value="{{ $item_service->service_id }} " hidden >
                            <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            disabled name="service_name" value="{{ $item_service->service_name }}">
                        @endforeach
                    </div>
                    <!-- This div will be display after clicking on the button modifier -->
                    <div class="input-group mb-3 col-12" id="service">
                        <select class="form-control col-12 input-login" name="service_id">
                            <option value="" selected disabled>Sélectionner le service</option>
                            @foreach ($service as $item_service)
                                <option value="{{ $item_service->service_id }}">{{ $item_service->service_name }} </option>
                            @endforeach
                        </select>
                    </div>
                    @error('service_names')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text text-white col-4 input-login">Rôle</span>
                        <input type="text" id="role" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                        disabled  name="role" value="{{ $item->role }}">
                            
                    </div>
                    <div class="col-12">
                        <div class="col-8 offset-2" id="modify">
                           <button class="btn input-login col-12 cursor">Modifier</button>
                        </div>
                        <div class="col-8 offset-2" id="update">
                            <button class="btn input-login col-12 cursor" type="submit">Mettre à jour</button>
                         </div>
                    </div>
            </div>  
        </form>
        @endforeach
    </main>
<script src="{{ asset('js/users/show.js')}}"></script>
@endsection

@extends('layout/header')
@extends('layout/menu')
