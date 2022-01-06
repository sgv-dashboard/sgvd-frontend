@extends('master')
@section('content')
<div class="main-background">
    <div class="main-title">
        <p style = "color:white;" > Om de activiteiten te raadplegen dien je eerst in te loggen.</p>
    </div>
    <div class="main-title">
        <a href="/googleLogin"><button> Login met Google </button></a>
    </div>
    <div class="main-title">
        <a href="/facebookLogin"><button> Login met Facebook </button></a>
    </div>
</div>

@endsection

