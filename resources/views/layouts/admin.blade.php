<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Formation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
    <link rel="shortcut icon" href="{{asset('img/logos_all/iconFormation.webp') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/css/configAll.css')}}">
    <style>
        .modal-backdrop{
            z-index: 1 !important;
        }
    </style>

@stack('extra-links')

</head>
<body>
    @if ($message = Session::get('creation_inter_error'))
        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger ms-2 me-2">
                        <ul>
                            <li>{{ $message }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
    @endif

    <div class="sidebar active">
        <ul class="nav nav_list mb-5" id="menu">
            {{-- @canany(['isSuperAdmin','isAdmin']) --}}
            <li>
                <a href="{{route('listeAbonne')}}" class="d-flex abonnees nav_linke">
                    <i class='bx bxl-sketch'></i>
                    <span class="links_name">Abonnées</span>
                </a>
            </li>
            {{-- @endcanany --}}
        </ul>
    </div>

    <div class="home_content">
        <div class="container-fluid p-0 height-100 bg-light" id="content">
            <header class="header row align-items-center g-0" id="header">
                <div class="col-3 d-flex flex-row padding_logo">
                    <span><img src="{{asset('img/logos_all/iconFormation.webp')}}" alt="" class="img-fluid menu_logo me-3"></span>@yield('title')
                </div>
                    <div class="col-12">
                        <div class="row justify-content-end">
                            <div class="col-12 text-end icones_header">
                                {{-- @can('isSuperAdmin') --}}
                                    <a class="dropdown-toggle p-1" id="dropdownMenuCreer" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-plus-medical icon_creer_admin'></i></a>
                                    <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuCreer">
                                        <li><a class="dropdown-item" href="#"> <i
                                                    class='bx bxs-doughnut-chart icon_plus'></i>&nbsp;Nouveau type
                                            </a></li>
                                            <li id="abo"><a class="dropdown-item" href="#"> <i
                                                class='bx bx-money '></i>&nbsp;Nouveau coupon
                                        </a></li>
                                        <li id="formation"><a class="dropdown-item" href="#"> <i
                                            class='bx bx-cross '></i>&nbsp;Nouvelle formation
                                        </a></li>
                                    </ul>
                                {{-- @endcan --}}
                                <a class="dropdown-toggle p-1" id="dropdownMenuSuite" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-grid-alt bx-burst-hover icon_creer_admin'></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSuite">
                                    <div class="card card_suite">
                                        <div class="card-body py-0">
                                            <div class="row">
                                                <div class="col-4 px-0 logo_suite">
                                                    @can('isCFPPrincipale')
                                                        <a
                                                        {{-- href="{{route('profil_du_responsable')}}" --}}
                                                        class="text-center justify-content-center d-flex flex-column"><i class='bx bxs-user-circle icone_compte '></i><span class="mt-1">compte</span></a>
                                                    @endcan
                                                </div>
                                                <div class="col-4 px-0 logo_suite">
                                                    <a href="#" class="text-center justify-content-center d-flex flex-column"><img src="{{asset('img/logos_all/iconFormation.webp')}}" alt="logo formation" width="35px" height="35px" class="img-responsive mb-2"><span>formation</span></a>
                                                </div>
                                                <div class="col-4 px-0 logo_suite">
                                                    <a href="#" class="text-center justify-content-center d-flex flex-column"><img src="{{asset('img/logos_all/iconPaie.webp')}}" alt="logo formation" width="35px" height="35px" class="img-responsive mb-2"><span>paie</span></a>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-4 px-0 logo_suite">
                                                    <a href="#" class="text-center justify-content-center d-flex flex-column"><img src="{{asset('img/logos_all/iconConge.webp')}}" alt="logo formation" width="35px" height="35px" class="img-responsive mb-2"><span>congé</span></a>
                                                </div>
                                                <div class="col-4 px-0 logo_suite">
                                                    <a href="#" class="text-center justify-content-center d-flex flex-column"><img src="{{asset('img/logos_all/iconPersonel.webp')}}" alt="logo formation" width="35px" height="35px" class="img-responsive mb-2"><span>personel</span></a>
                                                </div>
                                                <div class="col-4 px-0 logo_suite">
                                                    <a href="#" class="text-center justify-content-center d-flex flex-column"><img src="{{asset('img/logos_all/iconRecrutement.webp')}}" alt="logo formation" width="35px" height="35px" class="img-responsive mb-2"><span>recrutement</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="dropdown-toggle p-1" id="dropdownMenuProfil" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-user-circle icon_creer_admin'></i></a>
                                <div class="dropdown-menu p-0" aria-labelledby="dropdownMenuProfil">
                                    <div class="card card_profile pt-3">
                                        <div class="card-title">
                                            <div class="row px-3 mt-2">
                                                <div class="col-7">
                                                    <span class="titre_card_profil"><img src="{{asset('img/logos_all/iconFormation.webp')}}" alt="logo_mini" title="logo formation.mg" width="30px" height="30px">Formation.mg</span>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <div class="logout">
                                                        <a
                                                        {{-- href="{{ route('logout') }}" --}}
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
                                                        <a
                                                        {{-- href="{{ route('logout') }}" --}}
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class=" text-center">Se déconnecter</a>
                                                        {{-- <form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
                                                            @csrf
                                                        </form> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="row ps-4">
                                                <div class="col-2 ps-4">
                                                    <span>
                                                        <div style="display: grid; place-content: center">
                                                            <div class='randomColor photo_users' style="color:white; font-size: 20px; border: none; border-radius: 100%; height: 65px; width: 65px ; display: grid; place-content: center">
                                                            </div>
                                                        </div>
                                                    </span>
                                                </div>
                                                <div class="col-10 ps-4">
                                                    <h6 class="mb-0 ">
                                                        {{-- {{Auth::user()->name}} --}}
                                                        rayan
                                                    </h6>
                                                    <h6 class="mb-0 text-muted text_mail">
                                                        {{-- {{Auth::user()->email}} --}}
                                                        rayan@gmail.com
                                                    </h6>
                                                    <p id="nom_etp" class="mt-2"></p>
                                                </div>
                                            </div>
                                            <div class="row role_liste mt-2">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="text" value="
                                                            {{-- {{Auth::user()->id}} --}}
                                                            " id="id_user" hidden>
                                                            <span class="text-muted p-0 test_font">Connécté en tant que :</span>
                                                        </div>
                                                        <div class="col p-0">
                                                            <ul id="liste_role" class="d-flex flex-column"></ul>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="d-flex flex-row py-0 justify-content-center">
                                                            <a href="{{url('politique_confidentialite')}}" target="_blank">
                                                                <p class="m-0 test_font2">Politique de confidentialité</p>
                                                            </a>
                                                            &nbsp;-&nbsp;
                                                            <a href="{{route('condition_generale_de_vente')}}" target="_blank">
                                                                <p class="m-0 test_font2">Conditions d'utilisation</p>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-row py-0 justify-content-center">
                                                            <a href="{{url('contacts')}}" target="_blank">
                                                                <p class="m-0 test_font2">Contactez-nous</p>
                                                            </a>
                                                            &nbsp;-&nbsp;
                                                            <a href="{{url('info_legale')}}" target="_blank">
                                                                <p class="m-0 test_font2">Informations légales</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            {{-- header --}}
            {{-- content --}}
            <div class="container-fluid content_body px-0 " style="padding-bottom: 1rem; padding-top: 4.5rem;">
                @yield('content')

                @yield('planningEtp')

            </div>
            {{-- content --}}
        </div>

        <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js"
            integrity="sha512-aDciVjp+txtxTJWsp8aRwttA0vR2sJMk/73ZT7ExuEHv7I5E6iyyobpFOlEFkq59mWW8ToYGuVZFnwhwIUisKA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        {{-- <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
            integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
        </script> --}}

        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js" integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

        <script src="{{asset('js/admin.js')}}"></script>
        <script src="{{asset('js/apprendre.js')}}"></script>
</body>

</html>
