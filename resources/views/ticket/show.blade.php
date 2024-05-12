@extends('layout/template')
@section('title')
    Gestion des utilisateurs
@endsection

@section('content')

    <main class="col-10 col-sm-7 offset-1">
        <div class="col-12 main-bar">
            <p class="fw-bold fs-5">Connecting the world</p>
        </div>

        <div class="border d-flex flex-end col-8 offset-4">
            <p class="col-4 offset-8">
                <a href="/ticketService" class="text-primary">Ticket de services</a>
            </p>
        </div>
        
        <table class="table border">    
            @foreach ($ticket as $item)
                <tr>
                    <td>Ticket title</td>
                    <td>{{ $item->ticket_name }} </td>
                </tr>

                <tr>
                    <td>Description</td>
                    <td>{{ $item->comments }}</td>
                </tr>

                <tr>
                    <td>Ticket Status</td>
                    <td>{{ $item->ticket_status }} </td>
                </tr>

                @if ($item->resolution == "Appointment")
                    <tr>
                        <td>Ticket Resolution</td>
                        <td>Ticket Planifié</td>
                    </tr>
                    <!-- Retrieving scheduling data
                    -->
                    @foreach ($scheduling as $item_scheduled)
                        <tr>
                            <td>Date de début</td>
                            <td>{{ $item_schedule->date_starte }}</td>
                        </tr>
                        <tr>
                            <td>Date de fin</td>
                            <td>{{ $item_scheduled->date_ended }}</td>
                        </tr>
                        <tr>
                            <td>Raison de la planification</td>
                            <td>{{ $item_scheduled->scheduled_reason }}</td>
                        </tr>
                    @endforeach
                @else 
                    @if ($item->resolution == 'Resolved')
                    <tr>
                        <td>Ticket Resolution</td>
                        <td>{{ $item->resolution }} </td>
                    </tr>
                        <tr>
                            <td>Closed by</td>
                            @if (Auth::user()->user_id == $item->user_id)
                                <td>Moi même</td>
                            @else 
                                @foreach ($users as $item_user)
                                    @if ($item->user_id == $item_user->user_id)
                                        <td> {{ $item_user->first_name }} {{ $item_user->last_name }} </td>
                                    @break
                                    @endif
                                @endforeach
                            
                            @endif
                        </tr>
                    @else
                        <tr>
                            <td>Opened by</td>
                            @if (Auth::user()->user_id == $item->user_id)
                                <td>Moi même</td>
                            @else 
                                @foreach ($users as $item_user)
                                    @if ($item->user_id == $item_user->user_id)
                                        <td> {{ $item_user->first_name }} {{ $item_user->last_name }} </td>
                                    @break
                                    @endif
                                @endforeach                        
                            @endif
                        </tr>
                    @endif
                @endif  
                   
                @if (empty($item->closed_at))
                    <tr>
                        <td>Opened at</td>
                        <td>{{ $item->opened_at }}</td>
                    </tr>
                @else
                    <tr>
                        <td>Opened at</td>
                        <td>{{ $item->opened_at }}</td>
                    </tr>
                    <tr>
                        <td>Closed at</td>
                        <td>{{ $item->closed_at }}</td>
                    </tr>
                @endif
            @endforeach
        </table>
        @foreach ($ticket as $item)
            @if($item->resolution == 'Resolved')
                <div class="col-8 offset-2">
                    <button class="col-12 btn ticket btn-ticket" disabled>Ticket Résolu et Fermé</button>
                </div>
                @break 
            @endif
            <!-- We retrieve all tickets who belongs to the service of user that are not opened yet 
              -- whether the tickets belong to him or not
            -->
            @if ($item->service_id == Auth::user()->service_id && $item->ticket_status == "Not opened")
                <form action="/ticket_opened" method="POST" class="col-12" id="ticket_view">
                    @csrf
                    <div class="col-12 row">                       
                        @if ($item->ticket_status == "Not opened")
                            <input type="text" value="{{ $item->ticket_id }}" name="ticket_id" hidden>
                            @error('ticket_id')
                                <div class="col-8 offset-2 alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <input type="text" value="{{ Auth::user()->user_id }}" name="user_id" hidden>
                            @error('user_id')
                                <div class="col-8 offset-2 alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="col-4 offset-2">
                                <button class="col-12 btn btn-ticket ticket" type="submit">Ouvrir le ticket</button>
                            </div>
                            <div class="col-4">
                                <button class="col-12 btn btn-ticket ticket" id="transfert_ticket">Transférer le ticket</button>
                            </div>
                        @endif
                    </div>
                </form> 
            @else        
                <!-- We retrieve all tickets who belongs to the service of user that are opened 
                -- and belong to him.
                -->    
                @if ($item->user_id == Auth::user()->user_id && Auth::user()->service_id == $item->service_id )
                    <form action="/validating_result" method="POST">
                        @csrf
                        <input type="text" value="{{ $item->ticket_id }}" name="ticket_id" hidden>
                        @error('ticket_id')
                                <div class="col-8 offset-2 alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        <input type="text" value=" {{ Auth::user()->user_id }}" name="user_id" hidden>
                        @error('user_id')
                                <div class="col-8 offset-2 alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        <div class="col-6 offset-3">
                            <select name="result" id="result" class="form-control col-12">
                                <option value="" selected disabled>Sélectionner une action</option>
                                <option value="resolved_with_confirm">Resolu avec confirmation</option>
                                <option value="resolved_waiting_confirm">En attente de confirmation</option>
                                <option value="not_resolved">Non Résolu</option>
                                <option value="scheduled">Planifier</option>
                            </select>
                        </div>
                        @error('result')
                                <div class="col-8 offset-2 alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        <br>
                        <!-- 
                            Not Resolved Block...
                            -- This block will be displayed when the option value "not_resolved" will be selected
                            -- and will be hidden if not 
                        -->
                        <div class="col-8 offset-2" id="not_resolved_reason">
                            <textarea name="not_resolved" class="form-control col-12" placeholder="Entrer la raison de la non résolution"></textarea>
                        </div><br>
                        <!-- Not Resolved Block ended... -->

                        <!-- 
                            Resolved Block
                            -- This block will be displayed when the option value "resolved_with_confirm" will be selected
                            -- and will be hidden if not
                        -->
                        <div class="col-8 offset-2 " id="resolved_bloc">
                            <div class="col-4" id="validate">
                                <button class="btn ticket btn-ticket col-12">Valider</button>
                            </div>
                            <div class="col-4 offset-3" id="create_archive">
                                <button class="btn ticket btn-ticket col-12 ">Créer une archive</button>
                            </div>
                        </div>
                        <!-- Resolved Block ended... -->
                    </form>
                @else 
                    <!-- We retrieve all tickets who belongs to the service of user that are opened 
                        -- and not belong to him. He will be able to asign himself if he judges necessary
                    -->   
                    @if ($item->user_id != Auth::user()->user_id && Auth::user()->service_id == $item->service_id )
                        <form action="/asign-to-me" method="POST" class="row">
                            @csrf
                            <div class="col-4 offset-2">
                                <button class="col-12 btn btn-ticket ticket" disabled>Déjà ouvert</button>
                            </div>
                            <div class="col-4">
                                <input type="text" value="{{ $item->ticket_id }}" name="ticket_id" hidden>
                                @error('ticket_id')
                                    <div class="col-8 offset-2 alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="text" value="{{ Auth::user()->user_id }}" name="user_id" hidden>
                                @error('user_id')
                                    <div class="col-8 offset-2 alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <button class="col-12 btn btn-ticket ticket" id="transfert_ticket">M'assigner le ticket</button>
                            </div>
                        </form>

                    @else 
                        @if ($item->user_id != Auth::user()->user_id && $item->resolution == 'Appointment')
                            <form action="">
                                <div class="col-6 offset-3">
                                    <button class="col-12 btn btn-ticket ticket" disabled>Ticket planifié pour résolution</button>
                                </div>
                            </form>
                        
                        @else 
                            <!-- 
                            -- otherwise, We can conclude that the ticked has been created by the Authenticated user and wait the resolution.
                            -- Because of this he will be able to make a recall if the ticket take too long to be
                            -- resolved by
                            -->   
                            <form action="/recall" method="POST" class="row">
                                @csrf
                                <input type="text" value="{{ Auth::user()->user_id }}" name="user_id" id="user_id" hidden>
                                @error('user_id')
                                    <div class="col-8 offset-2 alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <input type="text" value="{{ $item->ticket_id }}" name="ticket_id" id="ticket_id" hidden>
                                @error('ticket_id')
                                    <div class="col-8 offset-2 alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="col-8 offset-2">
                                    @if(isset($recall) && $recall == "Yes")
                                        <button class="col-12 btn btn-ticket ticket" id="transfert_ticket" disabled>Relance effectuée</button>
                                    @else 
                                        <button class="col-12 btn btn-ticket ticket" id="transfert_ticket">Faire une relance</button>
                                    @endif
                                </div>
                            </form>
                        @endif
                    @endif 
                @endif
            @endif
        @endforeach
        <br><br>
        <!-- This form will be shown when clicking on transfert button
        | -- The user will be able to select another service if he saw that 
        | -- The problem doesn't concern their service
        -->
        @foreach ($ticket as $item)
            <form action="/transfert_ticket" method="POST" class="col-12" id="transfert_ticket_form">
                @csrf
                <input type="text" name="user_id" value="{{ Auth::user()->user_id }}" id="user_id" hidden>
                @error('user_id')
                    <div class="col-8 offset-2 alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <input type="text" name="ticket_id" id="ticket_id" value="{{ $item->ticket_id }}" hidden>
                @error('ticket_id')
                    <div class="col-8 offset-2 alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="col-8 offset-2">
                    <select name="service_id" id="" class="col-12 form-control">
                        <option value="" selected disabled>Sélectionner le service</option>
                        @foreach ($services as $item)
                        <!-- Whe deactive the service of user because he cannot transfert a ticket to a service that he belongs to -->
                            @if ($item->service_id == Auth::user()->service_id)
                                <option disabled value="">{{ $item->service_name }}</option>
                            @continue
                            @endif
                            <option value="{{ $item->service_id }}">{{ $item->service_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('service_id')
                    <div class="col-8 offset-2 alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <br><br>
                <div class="col-8 offset-2">
                    <textarea name="reason" id="reason" class="col-12 form-control" placeholder="Raison du transfert"></textarea>
                </div>
                <div class="col-3 offset-7">
                    <button class="col-12 btn btn-ticket ticket" id="back">Retour</button>
                </div>
                <br><br>
                <div class="col-6 offset-3">
                    <button class="col-12 btn btn-ticket ticket" id="transfert_ticket">Transférer</button>
                </div>
            </form>
        @endforeach
         <!-- This form will be shown when clicking on transfert button
        | -- The user will be able to 
        | -- The problem doesn't concern their service
        -->

        <form action="/scheduled" method="POST" class="col-12" id="scheduled_form">
            @csrf
            <div class="text-center fs-3">Plannifier la résolution</div>
            <hr class="col-8 offset-2"><br>
            @foreach ($ticket as $item)
            <input type="text" name="ticket_id" id="ticket_id" value={{ $item->ticket_id }} hidden>
                <input type="text" value="{{ $item->ticket_manager_id }}" name="ticket_manager_id" hidden>
                
                @error('ticket_manager_id')
                    <div class="alert alert-danger col-12"> {{ $message }}</div>
                @enderror
            @endforeach
                <div class="row">
                    <div class="col-3 offset-3 input-login">
                        <label for="date_started" class="text-center">Date de début</label>
                    </div>
                    <div class="col-4 ">
                        <input type="date" class="form-control input-login" id="date_started" name="date_started">
                    </div>
                    @error('date_started')
                        <div class="alert alert-danger col-8 offset-2"> {{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="row">
                    <div class="col-3 offset-3 input-login">
                        <label for="date_ended" class="text-center">Date de fin</label>
                    </div>
                    <div class="col-4 ">
                        <input type="date" class="form-control input-login" id="date_ended" name="date_ended">
                    </div>
                    @error('date_ended')
                        <div class="alert alert-danger col-8 offset-2"> {{ $message }}</div>
                    @enderror
                </div>
                <br>
                <div class="col-7 offset-3">
                    <textarea name="scheduling_reason" id="scheduling_reason" class="col-12 form-control" placeholder="Raison de la planification"></textarea>
                </div>
                @error('scheduling_reason')
                        <div class="alert alert-danger col-8 offset-2"> {{ $message }}</div>
                    @enderror
                <br>
                <div class="col-4 offset-4" id="validate">
                    <button class="btn ticket btn-ticket col-12">Planifier</button>
                </div>
        </form>
    </main>
<script src="{{ asset('js/tickets/show.js') }}"></script>
@endsection

@extends('layout/header')
@extends('layout/menu')
