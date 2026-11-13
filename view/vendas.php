<?php
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Vendas - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <nav id="nav-painel" class="navbar navbar-expand-lg navbar-dark navbar-admin py-3 sticky-top">
        <div id="div-nav-container" class="container">
            <a id="link-brand-painel" class="navbar-brand fw-bold fs-4" href="painel.php">
                <i id="icone-brand-painel" class="fas fa-tools text-warning me-2"></i>ADMINISTRAÇÃO
            </a>
            <div id="div-nav-links" class="d-flex align-items-center">
                <a id="link-nav-painel" href="painel.php" class="btn btn-outline-light me-2"><i id="icone-nav-painel" class="fas fa-home me-1"></i> Painel</a>
                <a id="link-nav-usuarios" href="usuarios.php" class="btn btn-outline-light me-2"><i id="icone-nav-usuarios" class="fas fa-users me-1"></i> Usuários</a>
                <a id="link-nav-produtos" href="produtos.php" class="btn btn-outline-light me-3"><i id="icone-nav-produtos" class="fas fa-box me-1"></i> Produtos</a>
                <a id="link-nav-sair" href="#" onclick="confirmSair()" class="btn btn-danger"><i id="icone-nav-sair" class="fas fa-sign-out-alt me-1"></i> Sair</a>
            </div>
        </div>
    </nav>

    <div id="div-container-principal" class="container my-5">
        <div id="div-painel-admin" class="painel-admin-box">
            <div id="div-cabecalho-vendas" class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h2 id="h2-titulo-vendas" class="fw-bold m-0"><i id="icone-titulo-vendas" class="fas fa-receipt text-info me-2"></i>Relatório Geral de Vendas</h2>
                <a id="link-voltar-painel" href="painel.php" class="btn btn-outline-secondary"><i id="icone-voltar-painel" class="fas fa-arrow-left me-1"></i> Voltar ao Painel</a>
            </div>

            <div id="div-tabela-vendas" class="table-responsive">
                <table id="tabela-vendas" class="table table-striped align-middle">
                    <thead id="thead-vendas" class="table-light">
                        <tr id="tr-cabecalho-vendas">
                            <th id="th-pedido">PEDIDO</th>
                            <th id="th-cliente">CLIENTE</th>
                            <th id="th-produto">PRODUTO</th>
                            <th id="th-qtd">QUANTIDADE</th>
                            <th id="th-total">VALOR TOTAL</th>
                            <th id="th-data">DATA DA VENDA</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-vendas">
                        <?php
                            require_once('../controller/vendaController.php');
                            $venda = new Venda();
                            $consulta = $venda->consulta();

                            foreach ($consulta as $linha) {
                                $id = $linha['id'];
                                $usuario = $linha['usuario'];
                                $produto = $linha['produto'];
                                $qtd = $linha['quantidade'];
                                $total = number_format($linha['valor_total'], 2, ',', '.');
                                $data = $linha['data_criado'];

                                echo "
                                <tr id='tr-venda-$id'>
                                    <td id='td-id-venda-$id'>#$id</td>
                                    <td id='td-cliente-venda-$id' class='fw-semibold'>$usuario</td>
                                    <td id='td-produto-venda-$id'>$produto</td>
                                    <td id='td-qtd-venda-$id'>$qtd</td>
                                    <td id='td-total-venda-$id' class='fw-bold text-success'>R$ $total</td>
                                    <td id='td-data-venda-$id' class='text-muted'>$data</td>
                                </tr>
                                ";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function confirmSair() {
            Swal.fire({
                title: "DESLOGAR!",
                text: "VOCÊ TEM CERTEZA?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#060",
                cancelButtonColor: "#aaa",
                cancelButtonText: "Não Deslogar!",
                confirmButtonText: "Deslogar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `../controller/usuarioController.php?action=sair`;
                }
            });
        }
    </script>
</body>
</html>
<?php
    } else {
        header('Location: index.php');
        exit();
    }
?>