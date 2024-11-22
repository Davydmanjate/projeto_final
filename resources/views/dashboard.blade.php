@extends('base.main')

@section('content')
<body>
    <div class="dashboard-influence">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h3 class="mb-2">Influencer Dashboard Template</h3>
                        <p class="pageheader-text">
                            Bem-vindo ao painel do usuário autenticado.
                        </p>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Painel</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Perfil do Usuário -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card influencer-profile-data">

                        <div class="border-top user-social-box">
                            <div class="user-social-media d-xl-inline-block">
                                <a href="{{ route('receita') }}" class="instagram-color" style="text-decoration: none;">
                                    <span class="mr-2"><i class="fab fa-instagram"></i></span><span>Receitas</span>
                                </a>
                            </div>
                            <div class="user-social-media d-xl-inline-block">
                                <a href="{{ route('despesa') }}" class="instagram-color" style="text-decoration: none;">
                                    <span class="mr-2"><i class="fab fa-instagram"></i></span><span>Despesas</span>
                                </a>
                            </div>
                            <div class="user-social-media d-xl-inline-block">
                                <a href="{{ route('relatorio') }}" class="instagram-color" style="text-decoration: none;">
                                    <span class="mr-2"><i class="fab fa-instagram"></i></span><span>Relatório</span>
                                </a>
                            </div>
                        </div>
                        <!-- Adicionando a nova seção de imagem -->
                        <div class="user-extra-image mt-6 text-center">

                            <img src="assets/images/pri.jpg" alt="Gráfico Financeiro" class="img-fluid rounded">
                            <p class="mt-2">Acompanhe suas receitas e despesas de maneira visual e intuitiva.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection
