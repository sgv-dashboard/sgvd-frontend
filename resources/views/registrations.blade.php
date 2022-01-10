@extends('master')

@section('content')
<div class="main-background">
    <div class="main-title start-page-margin">
        <h1 style="color:white;"> Hieronder kan je de inschrijvingen bekijken </h1>
    </div>
    <div class="activity-table">
        <div class="center-vertical">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>Activiteit</th>
                        <th>Tak</th>
                    </tr>
                </thead>
                <tbody id="activity-list-table">
                </tbody>
            </table>
        </div>
    </div>
    <div class="activity-info">
        <div class="detailed-info">
            <p class="activity-title" id="activity-title">Klik op een activiteit om inschrijvingen te zien</p>
            <p class="activity-date" id="activity-date" />
        </div>
        <table class="content-table">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Email</th>

                </tr>
            </thead>
            <tbody id="user-list-table">
            </tbody>
        </table>
    </div>
    <script type="text/javascript" src="js/registrations.js"></script>
    <!--
        <form class="add-activity-form inspringen">
            <input class="activity-inputs" type="date" id="searchDate" placeholder="Datum" required></input>
            <select class="activity-inputs" type="text" name="tak" id="searchTak" required>
                <option disabled="disabled" selected="true">Selecteer een tak</option>
                <option value="kapoenen">Kapoenen</option>
                <option value="kawellen">Kawellen</option>
                <option value="jonggivers">Jogi's</option>
                <option value="givers">Givers</option>
                <option value="jins">Jins</option>
                <option value="leiding">Leiding</option>
                <option value="stam">Stam</option>
            </select>
            <button type="button" onclick="searchActivities()"> Zoek </button>
        </form>
    -->
    <!--
        <div class="inspringen">
            <p1 class="search-activity-info" id="activityName" style="color:white;"></p1>
            <p1 class="search-activity-info" id="numberRegistrations" style="color:white;"></p1>
        </div>
    -->
</div>
@endsection