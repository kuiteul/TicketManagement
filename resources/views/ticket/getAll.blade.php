@extends('layout/template')
@section('title')
    Création d'un ticket
@endsection

@section('content')
    <main class="col-10 col-sm-7 offset-1">
            <div class="col-12 main-bar">
                <p class="fw-bold fs-5">Connecting the world</p>
            </div>
            <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Tous mes tickets</h2>
            @isset($success)
                <div class="alert alert-success col-12 text-center">{{ $success }}</div>
            @endisset
            <table class="border table">
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Intitulé</th>
                        <th>Date de création</th>
                        <th>&Eacute;tat</th>
                        <th>Service affecté</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="6" class="text-center text-info">Aucun ticket créé ce mois</th>
                    </tr>
                </tbody>
            </table>
        
    </main>

@endsection

@extends('layout/header')
@extends('layout/menu')