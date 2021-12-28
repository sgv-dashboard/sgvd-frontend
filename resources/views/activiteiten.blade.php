@extends('master')
@section('content')
<div class="main-background">
<div class="activity-container">
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
        <button type="button" onclick="getMapAndData()"> Tijdelijke knop om data te laden</button>
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
            <iframe id="map" width="620" height="400"></iframe>
        </div>
        <div class="detailed-info">
            <p> Weerbericht </p>
            <p> ...</p>
            <p> ...</p>
            <p> ...</p>
            <p> ...</p>
        </div>
    </div>
</div>
</div>


@endsection