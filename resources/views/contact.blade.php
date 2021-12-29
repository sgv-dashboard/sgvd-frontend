@extends('master')
@section('content')
<div class="main-background">
    <form action="https://formsubmit.co/siemen.vandervoort@student.uhasselt.be" method="POST">
        <input type="email" name="E-mail" placeholder="E-mail adres" required>
        <input type="text" name="Naam" placeholder="Naam" required>
        <input type="text" name="Bericht" placeholder="Bericht" required>
        <input type="hidden" name="_captcha" value="false">
        <inpt type="hidden" name="_next" value="http://localhost:3000/thankyou">
        <button type="submit">Versturen</button>
    </form>



    <div class="main-title">
        <div class="center">
            <h1 style = "color:white;" > Hier komt onze contact informatie</h1>
        </div>
    </div>
</div>
@endsection