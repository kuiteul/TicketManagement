@extends('layout/template')
@section('title')
    Gestion des utilisateurs
@endsection

@section('content')
    <main class="col-10 col-sm-7 offset-1">
            <div class="col-12 main-bar">
                <p class="fw-bold fs-5">Connecting the world</p>
            </div>
    @if (Auth::user()->role == "Auditor" || Auth::user()->role == "Admin")
  
            <h2 class="text-center text-uppercase fw-bold fs-1 title col-12">Liste de vos feedback</h2>
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
                    @if (isset($result) && $result == true)
                        <div class="btn btn-success">Liste des feedback</div>
                   @endif
                    @foreach ($feedback as $item)
                        <tr onclick="document.location.href='/feedback/{{ $item->feedback_id }}'" class="cursor">
                            <td>{{ $item->first_name }}</td>
                            <td>{{ $item->last_name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->service_names }}</td>
                        </tr></span>
                    @endforeach
                </tbody>
            </table>
    @else 
            <div class="alert alert-danger text-center ">Vous n'êtes pas authorisé à afficher cette option</div>
          
    @endif
        
    </main>

@endsection

@extends('layout/header')
@extends('layout/menu')