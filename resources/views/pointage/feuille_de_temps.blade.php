@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">Feuille de temps</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<style type="text/css">
    button,
    value {
        font-size: 30px;
    }

    .font_text strong,
    .font_text li,
    .font_text h3,
    .font_text h4,
    .font_text p {
        font-size: 12px;
    }

    .font_text h5,
    .font_text h6 {
        font-size: 10px;
    }

    .form_colab input {
        height: 50px;
        border: none;
        text-align: center
    }

    .form_colab input:focus {
        border: none;
        outline: none;
        box-shadow: none;
    }

    .form_colab span {
        height: 50px;
    }

    .form_colab input::placeholder {
        font-size: 12px
    }

    .nav_bar_list:hover {
        background-color: transparent;
    }

    .nav_bar_list .nav-item:hover {
        border-bottom: 2px solid black;
    }

    h6,
    p {
        font-size: 80%;
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

    td {
        padding: 0 !important;
        height: 50px !important;
    }

    table {
        empty-cells:show;
    }
</style>

<div class="container-fluid">

    <div class="row g-0">
        <div class="row mt-2 justify-content-center">

            <div class="col-md-8 jusitfy-content-center">
                <form name="formInsert" id="formInsert" action="" method="POST" enctype="multipart/form-data" class="form_insert_formateur form_colab  needs-validation" novalidate>
                    @csrf
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        <strong>{{Session::get('success')}}</strong>
                    </div>

                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{Session::get('error')}}
                    </div>
                    @endif

                    <table id="example" class="table ">
                        <thead style="background-color: #c7c9c939">
                            <tr align="center">
                                <th colspan="5"><h3> Ravelojaona Yves Rayan </h3></th>
                            </tr>
                            <tr align="center">
                                <th>Date</th>
                                <th>Entrée</th>
                                <th>Pause</th>
                                <th>Sortie</th>
                                <th>Total en heure</th>
                            </tr>
                        </thead>
                        <tbody id="newRowMontant">

                            @for($i = 1; $i <= 10; $i++)
                            <tr align="center" height="20px">
                                <td>
                                    <input class="form-control mx-0 " type="date" name="matricule_[]">
                                    <p class="m-0" style="color: red" name="matricule_err_[]" id="matricule_err_[]"></p>
                                </td>
                                <td>
                                    <input class="form-control"  type="time" name="nom_[]">
                                    <p class="m-0" style="color: red" name="nom_err_[]" id="nom_err_[]"></p>
                                </td>
                                <td>
                                    <input class="form-control" id="inlineFormInput" type="number" name="prenom_[]">
                                </td>
                                <td>
                                    <input class="form-control" type="time" name="cin_[]">
                                    <p class="m-0" style="color: red" name="cin_err_[]" id="cin_err_[]"></p>
                                </td>
                                <td>
                                    <input class="form-control" type="email" readonly name="email_[]">
                                    <p class="m-0" name="email_err_[]" style="color: red" id="email_err_[]"></p>
                                </td>
                                </tr>
                                @endfor
                            <tr align="center">
                                <td colspan="3" class="border-0 "></td>
                                <td><h5> Total heure de la semaine : </h5></td>
                                <td>40 heures</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="form-group mb-2" align="center">
                        <button type="submit" class="btn btn_creer ">sauvegarder</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
@endsection
