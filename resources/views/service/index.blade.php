@extends('layout/template')
@section('title')
    Création d'un ticket
@endsection

@section('content')   

    <main class="col-10 col-sm-7 offset-1">
            <div class="col-12 main-bar">
                <p class="fw-bold fs-5">Connecting the world</p>
            </div>
            <p class="col-2 offset-10">
                <a href="/service/create" class="col-12 text-primary">Créer un service</a>
            </p>
            <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Tous les services</h2>
            @isset($success)
                <div class="col-12 alert alert-success text-center">Le service a été créé avec success</div>
            @endisset
            <table class="border table">
                <thead>
                    <tr>
                        <th>Service ID</th>
                        <th>Service name</th>
                        <th>Location</th>
                        <th>Chef Service</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($service as $item)
                    <tr>
                        <td>##{{ $item->service_id }}</td>
                        <td>{{ $item->service_name}}</td>
                        <td>{{ $item->service_location }}</td>
                        <td>{{ $item->telephone }} </td>
                        <td><a href="/service/{{ $item->service_id }}/edit" class="text-primary">Modifier</a></td>
                        <td>
                            <form action="/service/{{ $item->service_id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        
    </main>
    
@endsection

@extends('layout/header')
@extends('layout/menu')