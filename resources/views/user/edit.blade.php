@extends('layout/template')
@section('title')
    Gestion des utilisateurs
@endsection

@section('content')
    
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">
            Mise à jour de 
            @foreach ($collection as $item)
                {{ $item->first_name }}
            @endforeach
        </h2>
        <hr>
        <!-- 
            |
            | Formulaire de création de ticket 
            |
        -->
        
        @foreach ($collection as $item)
        <form action="/users/{{ $item->employee_id }}" class="col-12" method="PUT">
            @csrf <!-- Clé de contrôle du formulaire -->
            @isset($error)
                <div class="col-12 alert alert-danger text-center">{{ $error }}</div>
            @endisset
            <div class="col-6 offset-3">
                    
                    <!-- Zone de texte du prénom -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Prénom </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer le prénom" name="first_name" value="{{ $item->first_name }}">
                    </div>
                    @error('first_name')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone de texte du nom -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Nom </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer le nom" name="last_name" value="{{ $item->last_name }}">
                    </div>
                    @error('last_name')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone de texte de l'adresse email -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Email </span>
                        <input type="email" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer une adresse email" name="email" value="{{ $item->email }}">
                    </div>
                    @error('email')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone de texte de la fonction -->
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-4 text-white text-center input-login" id="">Poste </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer le poste occupée" name="title" value="{{ $item->title }}">
                    </div>
                    @error('title')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <!-- Zone du service affecté -->
                    <div class="input-group mb-3 col-12">
                        <span class="input-group-text text-white col-4 input-login" id="">Service</span>
                        <select name="service_id" id="" class="form-control input-login">  
                            <option value="{{ $item->service_id}}"selected>{{ $item->service_names }}</option>
                            <!-- 
                                | We make appears items from services table

                            -->
                          @foreach ($service as $itemService)
                                <!-- 
                                    | We hide the service name that is already |
                                    | displayed by default                     |
                                -->
                                @if ($itemService->service_names == $item->service_names)
                                    <option value="{{ $itemService->service_id }}" hidden>{{ $itemService->service_names }}</option>
                                @else 
                                <!-- 
                                    | We display items that doesn't match      |

                                -->
                                    <option value="{{ $itemService->service_id }}">{{ $itemService->service_names }}</option>
                                @endif
                             
                          @endforeach
                        </select>
                    </div>
                    @error('service_names')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text text-white col-4 input-login">Admin</span>
                        <input type="checkbox" class="col-2" aria-label="Sizing example input" 
                            aria-describedby="inputGroup-sizing-default" name="admin">
                            
                    </div>
                    <div class="col-12 row">
                        <div class="col-5">
                            <a href="/users/{{ $item->employee_id }}"><button class="btn input-login col-12 cursor">Enregistrer</button></a>
                        </div>
                        <div class="col-5 offset-2"> 
                            <a href="/users                                                       "><button class="btn input-login col-12 cursor">Retour</button></a>
                        </div>
                    </div>
            </div>  
        </form>
        @endforeach
    </main>

@endsection

@extends('layout/header')
@extends('layout/menu')
