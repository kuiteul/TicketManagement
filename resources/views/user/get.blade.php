@extends('layout/template')
@section('title')
    Gestion des utilisateurs
@endsection

@section('content')
    <main class="col-10 col-sm-7 offset-1">
            <div class="col-12 main-bar">
                <p class="fw-bold fs-5">Connecting the world</p>
            </div>
            <p class="col-2 offset-10">
                <a href="/users" class="col-12 text-primary">Liste des utilisateurs</a>
            </p>
            <h2 class="text-center text-uppercase fw-bold fs-2 title col-12">Informations sur 
                @foreach ($collection as $item)
                    {{ $item->first_name }}
                @endforeach
            </h2>
            <hr>
            @isset($success)
                <div class="alert alert-success col-12 text-center">{{ $success }}</div>
            @endisset
            <div class="col-10 offset-1">
                @foreach ($collection as $item)
                   
                <div class="fs-4 col-10 offset-1 text-center"> 
                    <label for="nom" class="label col-5 text-end">Prénom : </label> 
                    <input type="text" disabled class="col-5 offset-1 border-0 title" value="{{ $item->first_name }}">
                </div>
                <div class="fs-4 col-10 offset-1 text-center"> 
                    <label for="nom" class="label col-5 text-end">Nom : </label> 
                    <input type="text" disabled class="col-5 offset-1 border-0 title" value="{{ $item->last_name }}">
                </div>
                <div class="fs-4 col-10 offset-1 text-center"> 
                    <label for="nom" class="label col-5 text-end">Email : </label> 
                    <input type="text" disabled class="col-5 offset-1 border-0 title" value="{{ $item->email }}">
                </div>
                <div class="fs-4 col-10 offset-1 text-center"> 
                    <label for="nom" class="label col-5 text-end">Poste : </label> 
                    <input type="text" disabled class="col-5 offset-1 border-0 title" value="{{ $item->title }}">
                </div>
                <div class="fs-4 col-10 offset-1 text-center"> 
                    <label for="nom" class="label col-5 text-end">Service : </label> 
                    <input type="text" disabled class="col-5 offset-1 border-0 title" value="{{ $item->service_names }}">
                </div>
                <div class="fs-4 col-10 offset-1 text-center"> 
                    <label for="nom" class="label col-5 text-end">Lieu du service : </label> 
                    <input type="text" disabled class="col-5 offset-1 border-0 title" value="{{ $item->locations }}">
                </div>
                <div class="fs-4 col-10 offset-1 text-center"> 
                    <label for="nom" class="label col-5 text-end">Tél service : </label> 
                    <input type="text" disabled class="col-5 offset-1 border-0 title" value="{{ $item->tel_extension }}">
                </div>
                <div class="fs-4 col-10 offset-1 text-center"> 
                    <label for="nom" class="label col-5 text-end">Créé le : </label> 
                    <input type="text" disabled class="col-5 offset-1 border-0 title" value="{{ $item->created_at }}">
                </div>
                <hr >
                <div class="col-12 row">
                    <div class="fs-4 col-4"> 
                        <a href="/users/{{ $item->employee_id }}/edit"><button class="btn input-login col-12 cursor fs-6">&Eacute;diter</button></a>
                    </div>
                    <div class="fs-4 col-4"> 
                        <a href="/users"><button class="btn input-login col-12 cursor fs-6">Reset mot de passe</button></a>
                    </div>
                    <div class="fs-4 col-4"> 
                        <a href="/users"><button class="btn input-login col-12 cursor fs-6">Supprimer</button></a>
                    </div>
                </div>
            @endforeach
            </div>
    </main>

@endsection

@extends('layout/header')
@extends('layout/menu')