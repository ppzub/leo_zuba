@extends('layouts.app')

@section('header')
    @include('layouts.header')
@endsection

@section('content')
<div class="container">
    <div class="row grey-text text-darken-2">
        <div class="col xl12 l12 m12 s12">
                <h5>Створити новий пароль</h5>
                @include('admin.errors')
                    <form method="POST" action="{{ route('reset', $token) }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row">
                            <div class="input-field col xl4 l4 m6 s12">
                                <input id="email" type="email" class="validate" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                            <label for="email">Електронна почта</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col xl4 l4 m6 s12">
                                <input id="password" type="password" class="validate" name="password" required>
                            <label for="password">Пароль</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col xl4 l4 m6 s12">
                                <input id="password-confirm" type="password" class="validate" name="password_confirmation" required>
                                <label for="password-confirm">Підтвердіть пароль</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col xl4 l4 m6 s12">
                                <button type="submit" class="btn waves-effect waves-light">
                                    Готово
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection
