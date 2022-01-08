@extends('master')
@section('content')

<div class="main-background">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="main-title start-page-margin">
            <h1 style = "color:white;" > Admin </h1>
    </div>
    <div class="users-table">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Gebruikersnaam</th>
                        <th>Toegang tot activiteiten</th>
                        <th>Email</th>
                        <th>Admin</th>
                    </tr>
                </thead>
                <tbody id="user-list-table">
                </tbody>
            </table>
        </div>
    <script type="text/javascript" src="js/users.js"></script>
</div>

@endsection