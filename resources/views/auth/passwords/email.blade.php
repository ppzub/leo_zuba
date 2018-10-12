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
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row">
                            <div class="input-field col xl4 l4 m6 s12">
                                <input id="email" type="email" class="validate" name="email" value="{{ old('email') }}" required>
                                <label for="email"">Електронна почта</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col xl4 l4 m6 s12">
                                <button type="submit" class="btn waves-effect waves-light">
                                    Відправити лінк зміни паролю
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection
