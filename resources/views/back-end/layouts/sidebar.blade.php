@php
    $user = \Illuminate\Support\Facades\DB::table('users')->first();
    $authUser = Auth::user();
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route("dashboard")}}" class="brand-link">
        <span class="brand-text font-weight-light">Task-1</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('backend/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>


        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                     @if ($authUser->types === '1')
                            <li class="nav-item">
                                <a href="{{ route('shortenurl.index') }}" class="nav-link" id="side-shortenurl">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                    ShortenUrl
                                        {{-- <i class="fas fa-angle-left right"></i> --}}
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link" id="side-user">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                        All User
                                        {{-- <i class="fas fa-angle-left right"></i> --}}
                                    </p>
                                </a>
                            </li>
                        @else
                        <li class="nav-item">
                                <a href="{{ route('userGetData') }}" class="nav-link" id="side-shortenurl">
                                    <i class="nav-icon fas fa-edit"></i>
                                    <p>
                                    ShortenUrl
                                        {{-- <i class="fas fa-angle-left right"></i> --}}
                                    </p>
                                </a>
                            </li>
                            @endif
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
