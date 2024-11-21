@extends('base.main')
@section('content')

<body>
    <div class="container-fluid dashboard-content">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="page-header">
                    <h2 class="pageheader-title">Agendador de Tarefas</h2>
                </div>
            </div>
        </div>

        <div class="dashboard-short-list">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 co-12">
                    <section class="card card-fluid">
                        <h5 class="card-header drag-handle">Lista de Tarefas</h5>
                        <ul class="sortable-lists list-group list-group-flush list-group-bordered" id="items">
                            <!-- Lista será carregada dinamicamente -->
                        </ul>
                        <div class="card-footer">
                            <button id="addItem" class="btn btn-primary">+ Adicionar Campo</button>
                            <button id="newPage" class="btn btn-secondary">Abrir Nova Página</button>
                        </div>
                        <div class="card-footer text-right">
                            <h5>Total: <span id="totalSum">0</span></h5>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <script src="../assets/libs/js/main-js.js"></script>
    <script>
        $(document).ready(function () {
            const storageKey = "taskList";

            // Função para carregar os itens do localStorage
            function loadItems() {
                const storedItems = JSON.parse(localStorage.getItem(storageKey)) || [];
                $('#items').empty(); // Limpa a lista atual
                storedItems.forEach((item, index) => {
                    appendItem(item.description, item.value, index);
                });
                calculateTotal();
            }

            // Função para salvar itens no localStorage
            function saveItems() {
                const items = [];
                $('#items li').each(function () {
                    const description = $(this).find('.description-input').val();
                    const value = parseFloat($(this).find('.value-input').val()) || 0;
                    items.push({ description, value });
                });
                localStorage.setItem(storageKey, JSON.stringify(items));
            }

            // Função para adicionar item na lista
            function appendItem(description = "", value = 0, index = null) {
                const newItem = `
                <li class="list-group-item align-items-center drag-handle" data-index="${index !== null ? index : ''}">
                    <span class="drag-indicator"></span>
                    <div class="d-flex align-items-center w-100">
                        <input type="text" class="form-control description-input mr-2" placeholder="Descrição" value="${description}" />
                        <input type="number" class="form-control value-input mr-2" placeholder="Valor" value="${value}" />
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-light edit-item">Edit</button>
                            <button class="btn btn-sm btn-outline-light delete-item">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                </li>`;
                $('#items').append(newItem);
            }

            // Função para calcular o total
            function calculateTotal() {
                let total = 0;
                $('.value-input').each(function () {
                    total += parseFloat($(this).val()) || 0;
                });
                $('#totalSum').text(total.toFixed(2));
            }

            // Adicionar novo item
            $('#addItem').click(function () {
                appendItem();
                saveItems();
            });

            // Atualizar soma ao alterar valores
            $(document).on('input', '.value-input', function () {
                calculateTotal();
                saveItems();
            });

            // Atualizar descrição ao editar
            $(document).on('input', '.description-input', function () {
                saveItems();
            });

            // Deletar item
            $(document).on('click', '.delete-item', function () {
                $(this).closest('li').remove();
                calculateTotal();
                saveItems();
            });

            // Abrir nova página
            $('#newPage').click(function () {
                window.open('{{ url("/nova-pagina") }}', '_blank');
            });

            // Carregar itens ao abrir a página
            loadItems();
        });
    </script>
</body>

@endsection
