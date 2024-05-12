@extends('layout/template')
@section('title')
    Page d'accueil | Tableau de board
@endsection

@section('content')
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">tableau de board</h2>
        <hr>
        <div class="row col-12 justify-content-around block-ticket">
            <section class="ticket fw-bold col-4 col-md-3">
                <a href="/ticketService/"><p class="text-center  col-12">Tickets de service</p>
                <p class="text-center  col-12 fs-3">{{ $ticket_service }}</p></a>
            </section>
            <section class="ticket fw-bold col-4 col-md-3">
                <a href="/asign-to-me"><p class="text-center  col-12">Tickets à traiter</p>
                <p class="text-center  col-12 fs-3">{{ $ticket_asign_to_user }}</p></a>
            </section>
            <section class="ticket fw-bold col-4 col-md-3">
                <a href="/intreatment"><p class="text-center  col-12">Tickets en traitement</p>
                    <p class="text-center  col-12 fs-3">{{ $ticket_in_processing }}</p></a>
            </section>

            <h3 class="text-center">&Eacute;tat de mes tickets créés</h3>
            <hr><br>
            <section class="ticket fw-bold col-4 col-md-3">
                <a href="/notresolved"><p class="text-center  col-12">Tickets non résolus</p>
                <p class="text-center  col-12 fs-3">{{ $ticket_not_resolved }}</p></a>
            </section>

            <section class="ticket fw-bold col-4 col-md-3">
                <a href="/resolved"><p class="text-center  col-12">Tickets Résolus</p>
                <p class="text-center  col-12 fs-3">{{ $ticket_resolved }}</p></a>
            </section>
            <section class="ticket fw-bold col-4 col-md-3">
                <a href="/inappointment"><p class="text-center  col-12">Tickets planifiés</p>
                <p class="text-center  col-12 fs-3">{{ $ticket_in_appointment }}</p></a>
            </section>
        </div>
    </main>

@endsection

@extends('layout/header')
@extends('layout/menu')