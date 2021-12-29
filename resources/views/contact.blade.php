@extends('master')
@section('content')
<div class="main-background">
    <form action="https://formsubmit.co/siemen.vandervoort@student.uhasselt.be" method="POST" class="center">
        <input class="below" type="email" name="E-mail" placeholder="E-mail adres" required></input>
        <input class="below" type="text" name="Naam" placeholder="Naam" required></input>
        <input class="below" type="text" name="Bericht" placeholder="Bericht" required></input>
        <input class="below" type="hidden" name="_captcha" value="false"></input>
        <input class="below" type="hidden" name="_next" value="http://localhost:3000/thankyou"></input>
        <button class="center-contact-button" type="submit">Versturen</button>
    </form>
</div>
@endsection