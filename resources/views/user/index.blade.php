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
                <a href="/users/create" class="col-12 text-primary">Ajouter un utilisateur</a>
            </p>
            <h2 class="text-center text-uppercase fw-bold fs-1 title col-12">Liste des utilisateurs</h2>
            @isset($success)
                <div class="alert alert-success col-12 text-center">{{ $success }}</div>
            @endisset
            <table class="border table">
                <thead>
                    <tr>
                        <th>Prénom</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Fonction</th>
                        <th>Service rattaché</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($result) && $result == false)
                        <div class="btn btn-danger col-12">L'utilisateur existe déjà</div>
                    @endif

                    @if (isset($result) && $result == true)
                        <div class="btn btn-success">L'utilisateur a été créé avec success</div>
                   @endif
                    @foreach ($user as $item)
                        <tr onclick="document.location.href='/users/{{ $item->user_id }}'" class="cursor">
                            <td>{{ $item->first_name }}</td>
                            <td>{{ $item->last_name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->service_names }}</td>
                        </tr></span>
                    @endforeach
                </tbody>
            </table>
        
    </main>

@endsection

@extends('layout/header')
@extends('layout/menu')