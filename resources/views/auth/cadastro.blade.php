@extends('base1.main')
<body>
    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center">
                <a href="#">
                    <img class="logo-img" src="{{ asset('assets/images/cadastro.jpg') }}" alt="logo">
                </a>
                <span class="splash-description">Cadastre-se na Gestão Financeira.</span>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('cadastro') }}">
                    @csrf
                    <!-- Nome -->
                    <div class="form-group">
                        <label for="name">Nome Completo</label>
                        <input
                            class="form-control form-control-lg @error('name') is-invalid @enderror"
                            id="name"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="Digite seu nome completo"
                            required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            class="form-control form-control-lg @error('email') is-invalid @enderror"
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Digite seu email"
                            required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Telefone -->
                    <div class="form-group">
                        <label for="phone">Telefone</label>
                        <input
                            class="form-control form-control-lg @error('phone') is-invalid @enderror"
                            id="phone"
                            type="text"
                            name="phone"
                            value="{{ old('phone') }}"
                            placeholder="Digite seu telefone"
                            required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Senha -->
                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Digite sua senha"
                            required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Confirmar Senha -->
                    <div class="form-group">
                        <label for="password-confirm">Confirme a Senha</label>
                        <input
                            class="form-control form-control-lg"
                            id="password-confirm"
                            type="password"
                            name="password_confirmation"
                            placeholder="Confirme sua senha"
                            required>
                    </div>
                    <!-- Botão de Cadastro -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Cadastrar</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="{{ route('auth.login') }}" class="footer-link">Já tem uma conta? Faça login</a>
                </div>
            </div>
        </div>
    </div>
</body>

