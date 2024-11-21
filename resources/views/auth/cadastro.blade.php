<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastro</title>
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>
<body>
    <form class="splash-container" method="POST" action="{{ route('cadastro.store') }}">
        @csrf
        <div class="card">
            <div class="card-header">
                <div class="card-header text-center"><a href="../index.html"><img class="logo-img" src="{{asset('assets/images/cadastro.jpg')}}" alt="logo"></a>
                <p>Por favor, preencha os campos abaixo.</p></div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="name" required placeholder="Nome" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="email" required placeholder="E-mail" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg"
                           type="tel"
                           name="phone"
                           required
                           placeholder="Telefone"
                           pattern="[0-9]{9}"
                           maxlength="9"
                           title="Por favor, insira exatamente 9 dígitos"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 9)">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="password" type="password" required placeholder="Senha">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" name="password_confirmation" type="password" required placeholder="Confirme a Senha">
                </div>
                <div class="form-group pt-2">
                    <button class="btn btn-block btn-primary" type="submit">Cadastrar</button>
                </div>
                <div class="card-footer bg-white">
                    <p>Já possui conta? <a href="{{ route('auth.login') }}" class="text-secondary">Entrar aqui</a>.</p>
                </div>
            </div>
        </div>
    </form>
</body>
</html>
