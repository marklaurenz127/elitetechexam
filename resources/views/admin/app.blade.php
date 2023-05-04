<!doctype html>
<html lang="en">
 
<head>
    @include('includes.head')
    @yield('css')
    <style>
        .sidebar-dark{
            background-color: #292929 !important;
        }

        .dashboard-main-wrapper{
            padding-top: 0px !important;
        }

        .nav-left-sidebar{
            top: 0px !important;
        }

        .pt-30{
            padding-top: 30px;
        }

        body{
            background-color: #333333;
        }
        
        .footer{
            background-color: #292929 !important;
            color: white !important;
        }

        .footer a{
            color: white !important;
        }

        .color-black{
            color: black !important;
        }

        .card-space-bw{
            display: flex;
            justify-content: space-between;
        }

    </style>
</head>

<body>
    <div class="dashboard-main-wrapper">

    <!-- SIDE BAR -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="/">Dashboard</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="/"><i class="fa fa-fw fa-user-circle"></i>Home</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="/admins"><i class="fa fa-fw fa-users"></i>Admins</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="/crews"><i class="fa fa-fw fa-users"></i>Crews</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="/documents"><i class="fa fa-fw fa-box"></i>Documents</a>
                            </li>
                            <li class="nav-divider">
                                Logout
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="/auth/logout"><i class="fa fa-fw fa-user-circle"></i>Logout</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('includes.foot')
    @yield('js')
</body>

</html>