@extends('master')

@section('content')
<div class="main-background">
    <div class="main-title start-page-margin">
        <h1 style="color:white;"> Hieronder kan je de inschrijvingen bekijken </h1>
    </div>
    <form class="add-activity-form inspringen">
        <input class="activity-inputs" type="date" id="searchDate" placeholder=" Datum" required></input>
        <select class="activity-inputs" name="tak" id="searchTak" required>
            <option disabled="disabled" selected="true" >Selecteer een tak</option>
            <option value="Kapoenen">Kapoenen</option>
            <option value="Kawellen">Kawellen</option>
            <option value="Jogis">Jogi's</option>
            <option value="Givers">Givers</option>
            <option value="Jins">Jins</option>
            <option value="Leiding">Leiding</option>
            <option value="Groepsleiding">Groepsleiding</option>
            <option value="Stam">Stam</option>
        </select>
        <button type="button" onclick="searchActivities()"> Zoek </button>
    </form>
    <div class="inspringen">
        <p1 class="search-activity-info" id="activityName" style="color:white;"></p1>
        <p1 class="search-activity-info" id="numberRegistrations" style="color:white;"></p1>
    </div>
    <div class="activity-table">
        <div class="center-vertical">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Naam lid</th>
                    </tr>
                </thead>
                <tbody id="search-activity-list-table">
                </tbody>
            </table>
        </div>
    </div>
    <script type="text/javascript" src="js/activities.js"></script>
</div>
@endsection