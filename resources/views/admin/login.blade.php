@extends('admin.layout')

@section('title', 'Login Admin')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm">
            <div class="card-header text-center">
                <h5 class="mb-0">Acceso administración</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text"
                               name="username"
                               id="username"
                               class="form-control @error('username') is-invalid @enderror"
                               value="{{ old('username') }}"
                               required
                               autofocus>
                        @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Clave</label>
                        <input type="password"
                               name="password"
                               id="password"
                               class="form-control @error('password') is-invalid @enderror"
                               required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Ingresar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

