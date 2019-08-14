<b-carousel
id="carousel-fade"
style="text-shadow: 0px 0px 2px #000"
fade
indicators
img-width="1024"
img-height="300"
>
<b-carousel-slide
  caption="Learn more"
  img-src="{{ asset('/images/pic3.jpg') }}"
></b-carousel-slide>
<b-carousel-slide
  caption="Answer more"
  img-src="{{ asset('/images/pic2.jpg') }}"
></b-carousel-slide>
</b-carousel>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <a class="navbar-brand" href="/">iQueTestBank</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        @auth
      <li class="nav-link">
          <v-icon left small dark>person</v-icon>{{ Auth::user()->name }}</li>
          @if(auth()->user()->end_user == 'admin' || auth()->user()->end_user == 'dean')
       <li class="nav-item">
              <a class="nav-link" href="{{ route('user') }}">
                  <v-icon  center small dark>security</v-icon>  User
              </a>
            </li>
            @endif
            <li class="nav-item dropdown">
               
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{-- <a class="nav-link" href="{{ route('test') }}"> --}}
                    <v-icon center small dark>cloud_download</v-icon>  Download
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @if(auth()->user()->end_user == 'admin' || auth()->user()->end_user == 'dean')
                    <a class="dropdown-item" href="{{ route('test') }}">User Questionaire</a>
                  @else
                <a class="dropdown-item" href="{{ route('faculty.test') }}">My Questionaire</a>
                    @endif
                </div>
              </li>
         
         
         <li class="nav-item">
          <a class="nav-link" href="{{ route('show.department') }}">  <v-icon center small dark>folder_open</v-icon> Deparment</a>
        </li>
        @endauth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <v-icon center small dark>widgets</v-icon> Menu {{-- {{ Auth::user()->name }} --}}
          </a>
         
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            @guest
            <a class="dropdown-item" href="{{ route('login') }}">Login</a>
            @endguest
            @auth
            <form method="POST" action="{{ route('logout') }}">
               {{ csrf_field() }}
               <input type="submit" class="dropdown-item" name="logout" value="Logout">
            </form>
           
            @endauth
          </div>
        </li>
  
      </ul>
    </div>
  </nav>
