@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">employés</p>
@endsection
@section('content')
{{-- <link rel="stylesheet" href="{{asset('assets/css/modules.css')}}"> --}}

<style>
    table,
    th {
        font-size: 11px;
    }

    table,
    td {
        font-size: 11px;
    }

    .nav_bar_list:hover {
        background-color: transparent;
    }

    .nav_bar_list .nav-item:hover {
        border-bottom: 2px solid black;
    }

    .input_inscription {
        padding: 2px;
        border-radius: 100px;
        box-sizing: border-box;
        color: #9E9E9E;
        border: 1px solid #BDBDBD;
        font-size: 16px;
        letter-spacing: 1px;
        height: 50px !important;
        border: 2px solid #aa076c17 !important;


    }

    .input_inscription:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 2px solid #AA076B !important;
        outline-width: 0 !important;
    }


    .form-control-placeholder {
        position: absolute;
        top: 1rem;
        padding: 12px 2px 0 2px;
        padding: 0;
        padding-top: 2px;
        padding-bottom: 5px;
        padding-left: 5px;
        padding-right: 5px;
        transition: all 300ms;
        opacity: 0.5;
        left: 2rem;
    }

    .input_inscription:focus+.form-control-placeholder,
    .input_inscription:valid+.form-control-placeholder {
        font-size: 95%;
        font-weight: bolder;
        top: 1rem;
        transform: translate3d(0, -100%, 0);
        opacity: 1;
        backgroup-color: white;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        box-shadow: 0 0 0 30px white inset !important;
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }

    .status_grise {
        border-radius: 1rem;
        background-color: #637381;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_reprogrammer {
        border-radius: 1rem;
        background-color: #00CDAC;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_cloturer {
        border-radius: 1rem;
        background-color: #314755;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_reporter {
        border-radius: 1rem;
        background-color: #26a0da;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_annulee {
        border-radius: 1rem;
        background-color: #b31217;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_termine {
        border-radius: 1rem;
        background-color: #1E9600;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_confirme {
        border-radius: 1rem;
        background-color: #2B32B2;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .statut_active {
        border-radius: 1rem;
        background-color: rgb(15, 126, 145);
        color: whitesmoke;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    /* .filter{
    position: relative;
    bottom: .5rem;
    float: right;
} */
    .btn_creer {
        background-color: white;
        border: none;
        border-radius: 30px;
        padding: .2rem 1rem;
        color: black;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }

    .btn_creer a {
        font-size: .8rem;
        position: relative;
        bottom: .2rem;
    }

    .btn_creer:hover {
        background: #6373812a;
        color: blue;
    }

    .btn_creer:focus {
        color: blue;
        text-decoration: none;
    }

    .icon_creer {
        background-image: linear-gradient(60deg, #f206ee, #0765f3);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        font-size: 1.5rem;
        position: relative;
        top: .4rem;
        margin-right: .3rem;
    }

    .pagination {
        background-clip: text;
        margin-right: .3rem;
        font-size: 2rem;
        position: relative;
        top: .7rem;
    }

    .pagination:hover {
        color: #000000;
        background-color: rgb(239, 239, 239);
        border-radius: 1.3rem;
    }

    .nombre_pagination {
        color: #626262;

    }

    .color-text-trie {
        color: blue;
    }

    .navigation_module .nav-link {
        color: #637381;
        padding: 5px;
        cursor: pointer;
        font-size: 0.900rem;
        transition: all 200ms;
        margin-right: 1rem;
        text-transform: uppercase;
        padding-top: 10px;
        border: none;
    }

    .nav-item .nav-link.active {
        border-bottom: 3px solid #7635dc !important;
        border: none;
        color: #7635dc
    }

    .nav-tabs .nav-link:hover {
        background-color: rgb(245, 243, 243);
        transform: scale(1.1);
        border: none;
    }

    .nav-tabs .nav-item a {
        text-decoration: none;
        text-decoration-line: none;
    }

</style>

<div class="container-fluid">
    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Filtre</a>

    <span class="nombre_pagination text-center filter"><span style="position: relative; bottom: -0.2rem">{{$pagination["debut_aff"]."-".$pagination["fin_aff"]." sur ".$pagination["totale_pagination"]}}</span>

        @if ($pagination["debut_aff"] >= $pagination["totale_pagination"])

        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif (($pagination["debut_aff"]+$pagination["nb_limit"]) >= $pagination["totale_pagination"])

        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif ($pagination["debut_aff"] == 1)

        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"])}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif ($pagination["debut_aff"] == $pagination["totale_pagination"] || $pagination["debut_aff"]> $pagination["totale_pagination"])

        <a href="{{route('employes.liste',$pagination["debut_aff"] -  $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{  route('employes.liste',$pagination["debut_aff"] +  $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @else

        <a href="{{ route('employes.liste',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('employes.liste',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        @endif

    </span>

    <div class="m-4">

        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a href="{{route('employes.liste')}}" class="nav-link active">
                    employés
                </a>
            </li>
            @canany(['isReferent','isReferentSimple'])
                <li class="nav-item">
                    <a href="{{route('employes.new')}}" class="nav-link">
                        nouveau employé
                    </a>
                </li>

            <li class="nav-item">
                <a href="{{route('employes.export.nouveau')}}" class="nav-link">
                    import EXCEL employé
                </a>
            </li>
            @endcanany
                <li class="nav-item">
                    <a href="{{route('employes.liste_referent')}}" class="nav-link">
                    Référents
                    </a>
                </li>
        </ul>

        <div class="row">
            <div class="col-12">
                <table id="example" class="table " style="width:100%">
                    <thead>
                        <tr>
                            <th class="id">ID</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Employé</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Contacts</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">
                                <span class="d-block">Département</span>
                                <span>Service</span>
                            </th>
                            @can('isReferent')
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Référent</th>
                            @endcan

                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Status</th>
                            @can('isReferent')
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Actions</th>
                            @endcan

                        </tr>


                    </thead>

                    <tbody>
                        @for ($i = 0;$i < count($employers);$i++ )




                            <tr >
                                <td class="align-middle id empNew" data-id={{$employers[$i]->user_id}} id={{$employers[$i]->user_id}} onclick="afficherInfos();" style="cursor: pointer">

                                    @if ($employers[$i]->activiter == 1)
                                        <span style="color:#00b900; "> <i class="bx bxs-circle"></i> </span>
                                    @else
                                        <span style="color:red; "> <i class="bx bxs-circle"></i> </span>
                                    @endif
                                    {{ $employers[$i]->matricule }}
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($employers[$i]->photos == null)
                                            {{-- image placeholder --}}
                                            {{-- <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="Image non chargée"
                                                style="width: 45px; height: 45px" class="rounded-circle" /> --}}

                                            {{-- grey color --}}
                                            {{-- <i class='bx bx-user-circle profile-holder'
                                                style="width: 45px; height: 45px"></i> --}}

                                            {{-- actif/inactif color --}}
                                                    {{-- <i class='bx bx-user-circle  h1' style='
                                                        @if ($employers[$i]->activiter == 1) color:#25b900c9;'
                                                            @else
                                                            color:#e21717;'
                                                            @endif
                                                            ></i> --}}

                                            {{-- initials --}}
                                                            <div class="randomColor rounded-circle p-3 mb-2 profile-circle" >
                                                                <span class="align-middle text-center profile-initial" style="position:relative;">
                                                                    <b data-id={{$employers[$i]->user_id}} id={{$employers[$i]->user_id}} onclick="afficherInfos();" class="empNew" style="cursor: pointer">{{substr($employers[$i]->nom_stagiaire, 0, 1)}} {{substr($employers[$i]->prenom_stagiaire, 0, 1)}}</b>
                                                                </span>
                                                            </div>
                                                        @else


                                                                <img data-id={{$employers[$i]->user_id}} id={{$employers[$i]->user_id}} onclick="afficherInfos();" src="{{ asset('images/employes/' . $employers[$i]->photos) }}"
                                                                alt="Image non chargée" style="width: 45px; height: 45px; cursor: pointer"
                                                                class="rounded-circle empNew" />



                                                        @endif
                                                    <div class="ms-3">
                                                        <p class="fw-normal mb-1 text-purple empNew" data-id={{$employers[$i]->user_id}} id={{$employers[$i]->user_id}} onclick="afficherInfos();" style="cursor: pointer">
                                                        {{-- <p class="fw-bold mb-1 text-purple "> --}}
                                                            {{ $employers[$i]->nom_stagiaire }} {{ $employers[$i]->prenom_stagiaire }}</p>
                                                        <p class="text-muted mb-0 empNew" data-id={{$employers[$i]->user_id}} id={{$employers[$i]->user_id}} onclick="afficherInfos();" style="cursor: pointer">{{ $employers[$i]->fonction_stagiaire }}</p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="align-middle text-start empNew" data-id={{$employers[$i]->user_id}} id={{$employers[$i]->user_id}} onclick="afficherInfos();" style="cursor: pointer">

                                                <div class="ms-3">
                                                    <p class="mb-1 text-purple">{{ $employers[$i]->mail_stagiaire }}</p>
                                                    {{-- <p class="fw-bold mb-1 text-purple">{{ $employers[$i]->mail_stagiaire }}</p> --}}
                                                    <p class="text-muted mb-0">
                                                        {{ $employers[$i]->telephone_stagiaire != null ? $employers[$i]->telephone_stagiaire : '----' }}
                                                    </p>


                                                </div>

                                            </td>
                                            <td class="align-middle text-center text-secondary">
                                                <p class="text-muted mb-0">
                                                    @if($employers[$i]->nom_departement == null OR  $employers[$i]->nom_service == null)
                                                    Non catégorisé
                                                    @else
                                                       {{$employers[$i]->nom_departement}} <br>
                                                        {{$employers[$i]->nom_service}}
                                                    @endif
                                                    {{-- {{ $employers[$i]->nom_departement != null ? $employers[$i]->nom_departement : 'Non catégorisé' }} <br>
                                                    {{ $employers[$i]->nom_service != null ? $employers[$i]->nom_service : 'Non catégorisé' }} <br> --}}
                                                </p>
                                            </td>
                                            @can('isReferent')
                                                <td class="align-middle text-center text-secondary">
                                                    @if($employers[$i]->activiter == 1)
                                                        @if($ref[$i] == 1)
                                                            <input class="form-check-input referent" type="checkbox" value="{{$employers[$i]->id}}" name = "referent"  id="flexCheckDefault" checked>
                                                        @else
                                                        <input class="form-check-input referent" type="checkbox" value="{{$employers[$i]->id}}" name = "referent"  id="flexCheckDefault">
                                                        @endif
                                                    @endif
                                                    @if($employers[$i]->activiter == 0)
                                                    <input disabled class="form-check-input referent" type="checkbox" value="{{$employers[$i]->id}}" name = "referent"  id="flexCheckDefault">
                                                    @endif
                                                </td>
                                            @endcan

                                            <td class="align-middle text-center text-secondary">

                                            @if ($employers[$i]->activiter == 1)
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked"><span
                                                            class="badge bg-success">actif</span></label>
                                                    @can('isReferent')
                                                        <input class="form-check-input desactiver_stg" type="checkbox"
                                                            data-user-id="{{ $employers[$i]->user_id }}" value="{{ $employers[$i]->id }}"
                                                            checked>
                                                    @endcan
                                                </div>
                                            @else
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label"
                                                        for="flexSwitchCheckChecked">
                                                        <span class="badge bg-danger">
                                                            inactif
                                                        </span>
                                                    </label>
                                                    @can('isReferent')
                                                    <input class="form-check-input activer_stg" type="checkbox"
                                                        data-user-id="{{ $employers[$i]->user_id }}" value="{{ $employers[$i]->id }}">
                                                    @endcan
                                                </div>
                                            @endif

                                    </td>
                                    @can('isReferent')
                                        <td class="align-middle text-center text-secondary">
                                            <button type="button" class="btn " data-bs-toggle="modal"
                                                data-bs-target="#delete_emp_{{ $employers[$i]->id }}">
                                                <i class=' bx bxs-trash' style='color:#e21717'></i>
                                        </button>
                                    @endcan
                                </td>

                            </tr>

                            <div class="modal fade" id="delete_emp_{{ $employers[$i]->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <form action="{{ route('mettre_fin_cfp_etp') }}" method="POST">
                                    @csrf

                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-center"
                                                style="background-color:rgb(235, 20, 45);">
                                                <h4 class="modal-title text-white">Avertissement !</h4>

                                            </div>
                                            <div class="modal-body">
                                                <small>Vous êtes sur le point d'enlever l'employé
                                                    {{ $employers[$i]->nom_stagiaire }} {{ $employers[$i]->prenom_stagiaire }},
                                                    cette action est irréversible. Continuer ?</small>
                                            </div>

                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non
                                                </button>

                                                <a href="{{ route('employeur.destroy', $employers[$i]->user_id) }}"> <button
                                                        type="button" class="btn btn_creer btnP px-3">Oui</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>


                        {{-- @empty --}}
                       @endfor





                    </tbody>
                </table>

            </div>
        </div>


        <div class="filtrer mt-3">
            <div class="row">
                <div class="col">
                    <p class="m-0">Filtre</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
                </div>
                <hr class="mt-2">
                <div class="row mt-0">
                    <p>
                        <a data-bs-toggle="collapse" href="#detail_par_thematique" role="button" aria-expanded="false" aria-controls="detail_par_thematique">Recherche par intervale de date de facturation</a>
                    </p>
                    <div class="collapse multi-collapse" id="detail_par_thematique">
                        <form class="mt-1 mb-2 form_colab" action="{{route('search_par_date')}}" method="GET" enctype="multipart/form-data">
                            @csrf
                            <label for="dte_debut" class="form-label" align="left"> Date de facturation <strong style="color:#ff0000;">*</strong></label>
                            <input required type="date" name="dte_debut" id="dte_debut" class="form-control" />
                            <br>
                            <label for="dte_fin" class="form-label" align="left">Date de règlement <strong style="color:#ff0000;">*</strong></label>
                            <input required type="date" name="dte_fin" id="dte_fin" class="form-control" />
                            <button type="submit" class="btn_creer mt-2">Recherche</button>
                        </form>
                    </div>
                    <hr>
                    <p>
                        <a data-bs-toggle="collapse" href="#search_num_fact" role="button" aria-expanded="false" aria-controls="search_num_fact">Recherche par N° facture</a>
                    </p>
                    <div class="collapse multi-collapse" id="search_num_fact">
                        <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('search_par_num_fact')}}" enctype="multipart/form-data">
                            @csrf
                            <label for="num_fact" class="form-control-placeholder">N° facture<strong style="color:#ff0000;">*</strong></label>
                            <input name="num_fact" id="num_fact" required class="form-control" required type="text" aria-label="Search" placeholder="Numero Facture">
                            <input type="submit" class="btn_creer mt-2" id="exampleFormControlInput1" value="Recherce" />
                        </form>
                    </div>
                    <hr>

                    <p>
                        <a data-bs-toggle="collapse" href="#detail_par_etp" role="button" aria-expanded="false" aria-controls="detail_par_etp">Recherche par activité</a>
                    </p>
                    <div class="collapse multi-collapse" id="detail_par_etp">
                        <form class="mt-1 mb-2 form_colab" action="#" method="GET" enctype="multipart/form-data">
                            @csrf
                            <label for="dte_debut" class="form-label" align="left">Organisme de formation<strong style="color:#ff0000;">*</strong></label>
                            <br>
                            <select class="form-select" autocomplete="on">
                                <option value="">actif</option>
                                <option value="">inactif</option>
                            </select>
                            <br>
                            <button type="submit" class="btn_creer mt-2">Recherche</button>
                        </form>
                    </div>
                    <hr>

                </div>
            </div>
        </div>


        {{--AfficheInfos--}}
        <div class="infos mt-3">
            <div class="row">
                <div class="col">
                    <p class="m-0 text-center">INFORMATION</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x " role="button" onclick="afficherInfos();"></i>
                </div>
                <hr class="mt-2">

                <div class="mt-2" style="font-size:14px">
                    {{-- <div class="mt-1">
                            <span class="text-center" style="height: 50px; width: 100px"><img src="{{asset('images/CFP/'.$centre->logo_cfp)}}" alt="Logo"></span>
                </div> --}}
                <div class="mt-1 text-center mb-3">
                    <span id="donner"></span>
                </div>

                <div class="mt-1 text-center">
                    <span id="nomEtp" style="color: #64b5f6; font-size: 18px; text-transform: uppercase; font-weight: bold"></span>
                </div>
                {{-- <div class="mt-1 mb-3 text-center">
                    <span id="prenom" style="font-size: 16px; text-transform: capitalize; font-weight: bold"></span>
                </div> --}}
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"><i class='bx bx-user'></i></div>
                        <div class="col-md-3">Nom_prénoms</div>
                        <div class="col-md">
                            <span id="nom" style="font-size: 14px; text-transform: uppercase; font-weight: bold"></span>
                            <span id="prenom" style="font-size: 12px; text-transform: Capitalize; font-weight: bold "></span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"><i class='bx bx-bookmark'></i></div>
                        <div class="col-md-3">Matricule</div>
                        <div class="col-md">
                            <span id="matricule" style="font-size: 14px; text-transform: uppercase; font-weight: bold"></span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"><i class='bx bx-envelope' ></i></div>
                        <div class="col-md-3">E-mail</div>
                        <div class="col-md"><span id="mail_stagiaire"></span></div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"><i class='bx bx-phone' ></i></div>
                        <div class="col-md-3">Télephone</div>
                        <div class="col-md">
                            <span></span><span id="telephone_stagiaire"></span>
                        </div>
                    </div>
                </div>
                <div class="mt-1">
                    <div class="row">
                        <div class="col-md-1"><i class='bx bx-location-plus' ></i></div>
                        <div class="col-md-3">Adresse</div>
                        <div class="col-md"><span id="adresse"></span></div>
                    </div>

                </div>
            </div>
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script>
            $('.empNew').on('click', function(){
                var user_id = $(this).data("id");
                console.log(user_id);
                $.ajax({
                    method: "GET"
                    , url: "/newAfficheInfo/employe/"+user_id
                    , dataType: "html"
                    , success: function(response) {
                        let userData = JSON.parse(response);
                        console.log(userData);
                        for (let $i = 0; $i < userData.length; $i++) {
                            let url_photo = '<img src="{{asset("images/employes/:url_img")}}" style="height80px; width:80px;">';
                            url_photo = url_photo.replace(":url_img", userData[$i].photos);
                            var nom = (userData[$i].nom_stagiaire).substr(0, 1);
                            var prenom = (userData[$i].prenom_stagiaire).substr(0, 1);

                            if(userData[$i].photos == null){
                                $('#donner').html(" ");
                                $('#donner').append('<p style="background-color: #5c6bc0; width: 80px; height: 80px; border-radius: 50%; padding: 30px; color: white; font-weight: 700; font-size: 14px; marging-bottom: 20px; position: relative; left: 40%"><span>'+nom+prenom+'</span></p>');
                            }else{
                                $("#donner").html(" ");
                                $("#donner").append(url_photo);
                            }

                            $("#matricule").text(': '+userData[$i].matricule);
                            $("#nom").text(': '+userData[$i].nom_stagiaire);
                            $("#prenom").text(userData[$i].prenom_stagiaire);
                            $("#mail_stagiaire").text(': '+userData[$i].mail_stagiaire);

                            if(userData[$i].telephone_stagiaire == null) var phone = "-------";
                            else var phone = userData[$i].telephone_stagiaire;

                            $("#telephone_stagiaire").text(': '+phone);

                            if(userData[$i].lot == null){
                                var lot = "-------"
                            }
                            else  var lot = userData[$i].lot;
                             if(userData[$i].quartier == null){
                                var quartier = "-------"
                            }
                            else  var quartier = userData[$i].quartier;

                            if(userData[$i].ville == null){
                                var ville = "-------"
                            }
                            else  var ville = userData[$i].ville;

                            if(userData[$i].region == null){
                                var region = "-------"
                            }
                            else  var region = userData[$i].region;
                            $("#adresse").text(': '+lot+' '+quartier+ ' '+ville+ ' '+region);
                            $("#code_postal").text(': '+userData[$i].code_postal);
                        }
                    }
                });
            });
        </script>
        <script>
            $(".randomColor").each(function() {
            //On change la couleur de fond au hasard
                $(this).css("background-color", '#'+(Math.random()*0xFFFFFF<<0).toString(16).slice(-6));
            });
        </script>

        <script type="text/javascript">

            /*============ stg =================*/
            $(".desactiver_stg").on('click', function(e) {
                var user_id = $(this).data("user-id");
                var stg_id = $(this).val();
                $.ajax({
                    type: "GET"
                    , url: "{{route('employes.liste.desactiver')}}"
                    , data: {
                        user_id: user_id
                        , emp_id: stg_id
                    }
                    , success: function(response) {
                        window.location.reload();
                    }
                    , error: function(error) {
                        console.log(error)
                    }
                });
            });
            $(".activer_stg").on('click', function(e) {
                var user_id = $(this).data("user-id");
                var stg_id = $(this).val();
                $.ajax({
                    type: "GET"
                    , url: "{{route('employes.liste.activer')}}"
                    , data: {
                        user_id: user_id
                        , emp_id: stg_id
                    }
                    , success: function(response) {
                        window.location.reload();
                    }
                    , error: function(error) {
                        console.log(error)
                    }
                });
            });


            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
                'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function(form) {
                        form.addEventListener('submit', function(event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            }

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()

            $('.referent').click(function() {
                var emp = $(this).val();
                if ($(this).is(':checked')) {
                    $.ajax({
                        type: "GET"
                        , url: "{{route('employes.ajouter.referent')}}"
                        , data: {
                            emp_id: emp
                        }
                        , success: function(response) {
                            window.location.reload();
                        }
                        , error: function(error) {
                            console.log(error)
                        }
                    });
                }
                else{
                    $.ajax({
                        type: "GET"
                        , url: "{{route('employes.supprimer.referent')}}"
                        , data: {
                            emp_id: emp
                        }
                        , success: function(response) {
                            window.location.reload();
                        }
                        , error: function(error) {
                            console.log(error)
                        }
                    });
                }
            });



        </script>

        @endsection