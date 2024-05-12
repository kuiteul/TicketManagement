@extends('layout/template')
@section('title')
    Création d'un ticket
@endsection

@section('content')
    
    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>
        <h2 class="text-center  text-uppercase fw-bold fs-1 title col-12">Créer un ticket</h2>
        <hr>
        <!-- 
            |
            | Formulaire de création de ticket 
            |
        -->
        <form action="/ticket" class="col-12" method="POST" enctype="multipart/form-data">
            @csrf <!-- Clé de contrôle du formulaire -->
            @isset($error)
                <div class="col-12 alert alert-danger text-center">{{ $message }}</div>
            @endisset
            <!-- id of user that create the ticket -->
            <input type="text" name="user_id" value="{{ Auth::user()->user_id }}" hidden>
            <div class="col-6 offset-3">
                    <div class="input-group mb-3 col-12 ">
                        <span class="input-group-text col-3 text-white text-center input-login" id="">Intitulé </span>
                        <input type="text" class="form-control input-login" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            placeholder="Entrer l'intitulé du ticket" name="ticket_label">
                    </div>
                    @error('ticket_label')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                      
                    <div class="input-group mb-3 col-12">
                        <span class="input-group-text text-white col-3 input-login" id="">Service </span>
                        <select name="service_id" id="" class="form-control input-login">  
                            <option value="" selected disabled>Selectionner le service</option>
                            @foreach ($service as $item)
                                @if ($item->service_id == Auth::user()->service_id)
                                    <option value="" disabled> {{ $item->service_name }} </option>
                                    @continue 
                                @endif
                                <option value="{{ $item->service_id }}">{{ $item->service_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('service_id')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <div class="input-group mb-3 col-12 ">
                        <label for="comments" class="col-12 text-white label input-login">Commentaires</label>
                        <textarea name="comments" id="comments" cols="30" rows="10" class="form-control text-area input-login"
                            placeholder="Rédiger un commentaire max 250 mots"></textarea>
                    </div>
                    @error('comments')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <div class="input-group mb-3 col-12 ">
                        <input type="file" name="images_file" id="" class="form-control input-login">
                    </div>
                    @error('images_file')
                        <div class="input-group col-12 mb-3 alert alert-danger"> {{ $message }} </div>
                    @enderror
                    <div class="input-group mb-3">
                        <input type="submit" class="btn-login col-8 offset-2" value="Enregistrer">
                    </div>

            </div>
        </form>
    </main>

@endsection

@extends('layout/header')
@extends('layout/menu')