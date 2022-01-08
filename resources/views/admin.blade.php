@extends('master')
@section('content')

<div class="main-background">
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