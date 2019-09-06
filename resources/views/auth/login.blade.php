@extends('layouts.app')
@section('css')
<link href="{{ asset('css/auth.css') }}" rel="stylesheet">
@endsection
@section('login')
    <div class="container" id="app_login">
        <div class="login-form">
            <div class="main-div">
                <div class="panel">
                    <h2>Admin Login</h2>
                    <p>Please enter your email and password</p>
                </div>
                <form id="Login">
                    <div class="form-group">
                        <input type="email" v-model="email" name="email" id="email" class="form-control" placeholder="Email Address" required autofocus>
                    </div>
                    <div class="form-group">   
                        <input type="password" v-model="password" name="password"class="form-control" id="password" placeholder="Password" required>
                    </div>
                    <button type="button" class="btn btn-primary" @click="login()" >Login</button>
                </form>
            </div>
        </div> 
    </div>

@endsection
