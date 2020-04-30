<div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <ul class="list-unstyled components">
                <p>Menu Principal</p>
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Call Center</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li>
                            <a href="{{ url('callcenter/generate') }}">Generador de Numeros</a>
                        </li>
                        <li>
                            <a href="{{ url('callcenter/calls') }}">Reporte de Llamadas</a>
                        </li>
                    </ul>
                    <a href="#facebookSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Facebook</a>
                    <ul class="collapse list-unstyled" id="facebookSubmenu">
                        <li>
                            <a href="{{ url('facebook/users') }}">Usuarios</a>
                            <a href="{{ url('facebook/postUser') }}">Publicaciones de Usuarios</a>
                            <a href="{{ url('facebook/blockUser') }}">Usuarios Bloqueados</a>
                        </li>
                    </ul>
                    <a href="#InstagramSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Instagram</a>
                    <ul class="collapse list-unstyled" id="InstagramSubmenu">
                        <li>
                            <a href="{{ route('usersInstagram')}}">Usuarios</a>
                        </li>
                    </ul>
                    <a href="#TwitterSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Twitter</a>
                    <ul class="collapse list-unstyled" id="TwitterSubmenu">
                        <li>
                            <a href="{{ route('usersTwitter')}}">Usuarios</a>
                        </li>
                    </ul>
                    <a href="#TaskSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Tareas</a>
                    <ul class="collapse list-unstyled" id="TaskSubmenu">
                        <li>
                            <a href="{{route('taskIndex')}}">Tareas</a>
                        </li>
                    </ul>
                    <a href="#ProfileSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Perfiles</a>
                    <ul class="collapse list-unstyled" id="ProfileSubmenu">
                        <li>
                            <a href="{{route('profileIndex')}}">Perfiles</a>
                            <a href="{{route('profileAdd')}}">Creacion</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
