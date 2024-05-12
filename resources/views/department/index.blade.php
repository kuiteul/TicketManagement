@extends('layout/template')
@section('title')
    Création d'un ticket
@endsection

@section('content')   

    <main class="col-10 col-sm-7 offset-1">
            <div class="col-12 main-bar">
                <p class="fw-bold fs-5">Connecting the world</p>
            </div>
            <p class="col-3 offset-9">
                <a href="/department/create" class="col-12 text-primary">Créer un département</a>
            </p>
            @isset($result)
                <div class="col-12 alert alert-success text-center">Le département a été créé avec success</div>
            @endisset
            <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Tous les départements</h2>
            <table class="border table">
                <thead>
                    <tr>
                        <th>Department ID</th>
                        <th>Department name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($department as $item)
                    <tr>
                        <td>#{{ $item->department_id}}</td>
                        <td>{{ $item->department_name }}</td>
                        <td><a href="/department/{{$item->department_id}}/edit" class="text-primary" rel="noopener noreferrer">Modifier</a></td>
                        <td>
                            <form action="/department/{{$item->department_id}}" method="POST">
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