@extends('master')

@section('content')
<div class="main-background">
    <div class="main-title start-page-margin">
        <h1 style="color:white;"> Klik op een activiteit voor meer info</h1>
    </div>
    <div class="activity-table">
        <div class="center-vertical">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Datum</th>
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
            <p class="activity-title" id="activity-title" />
            <p class="activity-date" id="activity-date" />
            <p class="activity-time" id="activity-time" />
            <p class="activity-group" id="activity-group" />
            <p class="activity-description" id="activity-description" />
        </div>
        <div class="detailed-info">
            <p> Routebeschrijving </p>
            <p1 id="distance"></p1>
            <p1 id="duration"></p1>
            <iframe id="map" srcdoc="" width="620" height="400"></iframe>
        </div>
        <div class="detailed-info">
            <p> Weerbericht </p>
            <p1 id="temperatuur"> </p1>
            <p1 id="gevoelstemperatuur"> </p1>
            <p1 id="windrichting"> </p1>
            <p1 id="windkmh"> </p1>
            <p1 id="samenvatting"> </p1>
        </div>
    </div>
    <script type="text/javascript" src="https://stevenlevithan.com/assets/misc/date.format.js"></script>
    <script type="text/javascript" src="js/activities.js"></script>
</div>
@endsection