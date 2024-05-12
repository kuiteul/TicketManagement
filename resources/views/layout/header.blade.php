@section('header')
    
    <header class="col-12 col-sm-10 offset-sm-1 ">
        <div class="row col-12">
            <section class="col-sm-2 ">
                <img src="{{asset('images/amt-logo.png')}}" class="col-9 offset-1" alt="">
            </section>

            <section class="col-sm-4 offset-sm-2 fs-1 fw-bold  title text-center">
                <p class="title-header">GESTION DES TICKETS</p>
            </section>

            <form class="col-sm-2 offset-sm-2" action="{{ url('logout')}} " method="POST">
                @csrf
                <button class="btn text-primary" type="submit">Se déconnecter</button>
            </form>
        </div>

        <div class="sub-header row col-12">
            <section class="col-4">
                Connected as {{ Auth::user()->first_name }} {{ Auth::user()->last_name }} <br>
                <small>{{ Auth::user()->title }} </small>
            </section>

            <section class="col-2 offset-6">
                Finance, Bonanjo <br />
                
            </section>
        </div>

    </header>

@endsection
