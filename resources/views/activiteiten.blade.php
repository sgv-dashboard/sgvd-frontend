@extends('master')

@section('javascipt')
<script type="text/javascript" src="js/activities.js"></script>
@endsection

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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>6/12/2021</td>
                        <td>Sinterklaas</td>
                    </tr>
                    <tr>
                        <td>1/5/2021</td>
                        <td>Eetdag</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <button type="button" onclick="getData()"> Tijdelijke knop om data te laden</button>
    </div>
    <div class="activity-info">
        <div class="detailed-info">
            <p> Info over de activiteit</p>
            <p> ...</p>
            <p> ...</p>
            <p> ...</p>
            <p> ...</p>
        </div>
        <div class="detailed-info">
            <p> Inschrijven </p>
            <p> ...</p>
            <p> ...</p>
            <p> ...</p>
            <p> ...</p>
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
</div>


@endsection