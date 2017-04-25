<nav class="nav has-shadow">
  <div class="container">
    <div class="nav-left">
      <a href="/" class="nav-item">
        <img src="/img/logo.png" alt="Tamarindo logo">
      </a>
       @if (!Auth::guest())
            <a href="/agenda" class="nav-item is-tab is-hidden-mobile {{ set_active('agenda') }}">Agenda</a>
            @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('subadmin'))
              <a href="/operations" class="nav-item is-tab is-hidden-mobile {{ set_active('operations') }}">Operations</a>
            @endif
            <a href="/reservations" class="nav-item is-tab is-hidden-mobile {{ set_active('reservations') }}">Reservations</a>
           @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('subadmin'))
            <a href="/destinations" class="nav-item is-tab is-hidden-mobile {{ set_active('destinations') }}" >Destinations</a>
            <a href="/vehicles" class="nav-item is-tab is-hidden-mobile {{ set_active('vehicles') }}">Vehicles</a>
            <a href="/users" class="nav-item is-tab is-hidden-mobile {{ set_active('users') }}">Users</a>
           @endif
      @endif
    </div>
    <span class="nav-toggle">
      <span></span>
      <span></span>
      <span></span>
    </span>
    <div class="nav-right nav-menu">
     @if (!Auth::guest())
           <a href="/agenda" class="nav-item is-tab is-hidden-tablet {{ set_active('agenda') }}">Agenda</a>
           @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('subadmin'))
            <a href="/operations" class="nav-item is-tab is-hidden-tablet {{ set_active('operations') }}">Operations</a>
           @endif
          <a href="/reservations" class="nav-item is-tab is-hidden-tablet {{ set_active('reservations') }}">Reservations</a>
          @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('subadmin'))
            <a href="/destinations" class="nav-item is-tab is-hidden-tablet {{ set_active('destinations') }}">Destinations</a>
            <a href="/vehicles" class="nav-item is-tab is-hidden-tablet {{ set_active('vehicles') }}" >Vehicles</a>
            <a href="/users" class="nav-item is-tab is-hidden-tablet {{ set_active('users') }}">Users</a>
          @endif
      @endif
       @if (Auth::guest())
          <a href="{{ route('login') }}" class="nav-item is-tab ">Login</a>
          <a href="{{ route('register') }}" class="nav-item is-tab ">Register</a>
      @else
      <a class="nav-item is-tab">
        <figure class="image is-16x16" style="margin-right: 8px;">
          <img src="http://bulma.io/images/jgthms.png">
        </figure>
        {{ Auth::user()->name }}
      </a>
      <a class="nav-item is-tab" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    
       @endif
    </div>
  </div>
</nav>