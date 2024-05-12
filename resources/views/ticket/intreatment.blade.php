@extends('layout/template')
@section('title')
    Gestion des utilisateurs
@endsection

@section('content')
    <main class="col-8" style="margin-left: 1.3%">
            <div class="col-12 main-bar">
                <p class="fw-bold fs-5">Connecting the world</p>
            </div>
            <p class="col-2 offset-10">
                <a href="/ticket/create" class="col-12 text-primary">Créer un ticket</a>
            </p>
            <h2 class="text-center text-uppercase fw-bold fs-1 title col-12">Mes tickets créés en traitement</h2>
            @isset($success)
                <div class="alert alert-success col-12 text-center">{{ $success }}</div>
            @endisset
            <table class="border table">
                <thead>
                    <tr>
                        <th>Ticket label</th>
                        <th>Résolution</th>
                        <th>Statut du ticket</th>
                        <th>Date d'ouverture</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($result) && $result == false)
                        <div class="btn btn-danger col-12">L'utilisateur existe déjà</div>
                    @endif

                    @if (isset($result) && $result == true)
                        <div class="btn btn-success">L'utilisateur a été créé avec success</div>
                   @endif
                    @foreach ($intreatment as $item)
                        <tr onclick="document.location.href='/ticket/{{ $item->ticket_id }}'" class="cursor" title="Click to open the ticket">
                            <td>{{ $item->ticket_name }}</td>
                            <td>{{ $item->resolution }} </td>
                            <td>{{ $item->ticket_status }}</td>
                            <td>{{ $item->opened_at }}</td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>

           
        
    </main>
    
@endsection

@extends('layout/header')
@extends('layout/menu')