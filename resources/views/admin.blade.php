@extends('master')
@section('content')

<div class="main-background">
    <div class="main-title start-page-margin">
        <h1 style="color:white;"> Admin </h1>
    </div>
    <div class="admin-section">
        <h1 style="color:white;"> Hieronder kan je activiteiten toevoegen </h1>
    </div>
    <form class="add-activity-form inspringen">
        <input class="activity-inputs" type="text" id="title" placeholder=" Naam activiteit" required></input>
        <input class="activity-inputs" type="date" id="date" placeholder=" Datum" required></input>
        <input class="activity-inputs" type="time" id="time" placeholder=" Tijd" required></input>
        <select class="activity-inputs" name="tak" id="tak" required>
            <option disabled="disabled" selected="true">Selecteer een tak</option>
            <option value="Kapoenen">Kapoenen</option>
            <option value="Kawellen">Kawellen</option>
            <option value="Jonggivers">Jogi's</option>
            <option value="Givers">Givers</option>
            <option value="Jins">Jins</option>
            <option value="Leiding">Leiding</option>
            <option value="Stam">Stam</option>
        </select>
        <input class="activity-inputs" type="text" id="City" placeholder=" Stad" required></input>
        <input class="activity-inputs" type="text" id="Street" placeholder=" Straat" required></input>
        <input class="activity-inputs" type="text" id="Number" placeholder=" Huisnummer" required></input>
        <input class="activity-inputs-discription" type="text" id="Discription" placeholder=" Beschrijving" required></input>
        <button type="button" onclick="saveActivities()"> Opslaan </button>
    </form>

    <div class="admin-section">
        <h1 style="color:white;"> Hieronder kan je rechten van leden aanpassen </h1>
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

    <div class="add-activity">

    </div>
    <script type="text/javascript" src="js/users.js"></script>
    <script type="text/javascript" src="js/activities.js"></script>
</div>

@endsection