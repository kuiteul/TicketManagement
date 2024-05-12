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
            <a href="{{ url('department') }}" class="col-12 text-primary">Liste des départements</a>
        </p>
        @isset($result)
            <div class="col-12 alert alert-success text-center">Le département a été créé avec success</div>
        @endisset
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Modification de</h2>
        <hr>
        @foreach ($department as $item)
            <form action="/department/{{ $item->department_id }}" method="post" class="col-8 offset-2">               
                @csrf
                @method('PUT')
                <input type="text" value={{ $item->department_id }} hidden name="department_id">
                <div class="input-group mb-3 col-8  ">
                    <span class="input-group-text col-3 text-white text-center input-login" id="">Nom</span>
                    <input type="text" name="department_name" class="form-control input-login" aria-label="Sizing example input" 
                        aria-describedby="inputGroup-sizing-default" placeholder="Entrer le nom du département" value="{{ $item->department_name }}">
                </div>
                @error('department_name')
                    <div class="col-12 alert alert-danger text-center">{{ $message }}</div>
                @enderror
                <div class="input-group mb-3">
                    <input type="submit" class="btn-login col-8 offset-2" value="Mettre à jour">
                </div>   
            </form>
        @endforeach
    </main>
    
@endsection

@extends('layout/header')
@extends('layout/menu')