<html>
    <head>
        <title>La vie en vrac - @yield('title')</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body>
        <div id="app">
            <header>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
            		<a class="navbar-brand mr-auto" href="#"><img src="{{ asset('assets/svg/logo.svg') }}" width="300" alt="Logo"></a>
                	<ul class="navbar-nav">
                    	<li class="nav-item" v-if="!$root.isLoggedIn">
                        	<a class="nav-link" href="#" @click="$root.showModal.login=true">Connexion</a>
                      	</li>
                      	<li class="nav-item" v-if="!$root.isLoggedIn">
                        	<a class="nav-link" href="#">Inscription</a>
                      	</li>
                      	<li class="nav-item" v-if="$root.isLoggedIn">
                      		<a class="nav-link" href="#" @click="$root.logout()">Déconnexion</a>
                      	</li>
                      	<li v-if="$root.isLoggedIn">
                      		<button type="button" class="btn btn-primary" @click="$root.showModal.addProduct=true;$root.clearContent=false">Ajouter un produit</button>
                      	</li>
    				</ul>
                </nav>
            </header>
            <main>
            	<router-view></router-view>
            </main>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
    </body>
</html>
