@extends('layout/template')
@section('title')
    Page d'administration
@endsection

@section('content')
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">tableau de board</h2>
        <div class="row col-12 justify-content-around block-ticket">
            <section class="ticket fw-bold col-4 col-md-2">
                <a href="/users" class="col-12"><p class="text-center  col-12">Gestion des utilisateurs</p></a>
                <p class="text-center  col-12 fs-3">{{ $user_number }} </p></a>
            </section>
            <section class="ticket fw-bold col-4 col-md-2">
                <a href="list_users"><p class="text-center  col-12">Gestion des tickets</p>
                <p class="text-center  col-12 fs-3">50</p></a>
            </section>  
            <section class="ticket fw-bold col-4 col-md-2">
                <a href="/department"><p class="text-center  col-12">Gestion des départements</p>
                <p class="text-center  col-12 fs-3">{{ $department_number }}</p></a>
            </section>  
            <section class="ticket fw-bold col-4 col-md-2">
                <a href="/service"><p class="text-center  col-12">Gestion des services</p>
                <p class="text-center  col-12 fs-3">{{ $service_number }}</p></a>
            </section>       
            <section class="ticket fw-bold col-4 col-md-2">
                <a href="list_users"><p class="text-center  col-12">Tickets Globaux</p>
                <p class="text-center  col-12 fs-3">{{ $ticket_number }}</p></a>
            </section>
            <section class="ticket fw-bold col-4 col-md-2">
                <a href="list_users"><p class="text-center  col-12">Rapport de traitement</p>
                <p class="text-center  col-12 fs-3">50</p></a>
            </section>
        </div>
    </main>

@endsection

@extends('layout/header')
@extends('layout/menu')