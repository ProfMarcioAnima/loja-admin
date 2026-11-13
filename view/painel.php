<?php
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>
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
                <a id="link-nav-usuarios" href="usuarios.php" class="btn btn-outline-light me-2"><i id="icone-nav-usuarios" class="fas fa-users me-1"></i> Usuários</a>
                <a id="link-nav-produtos" href="produtos.php" class="btn btn-outline-light me-2"><i id="icone-nav-produtos" class="fas fa-box me-1"></i> Produtos</a>
                <a id="link-nav-vendas" href="vendas.php" class="btn btn-outline-info me-3"><i id="icone-nav-vendas" class="fas fa-receipt me-1"></i> Vendas</a>
                <a id="link-nav-sair" href="#" onclick="confirmSair()" class="btn btn-danger"><i id="icone-nav-sair" class="fas fa-sign-out-alt me-1"></i> Sair</a>
            </div>
        </div>
    </nav>

    <div id="div-container-principal" class="container my-5">
        <div id="div-box-boas-vindas" class="painel-admin-box text-center py-5">
            <h1 id="h1-boas-vindas" class="fw-bold mb-3">Bem-vindo ao Painel de Controle</h1>
            <p id="p-descricao-painel" class="text-muted fs-5 mb-4">Utilize o menu superior para gerenciar usuários, controlar produtos e acompanhar as vendas da loja.</p>
            <div id="div-row-cards" class="row g-4 justify-content-center mt-3">
                <div id="div-col-usuarios" class="col-md-4">
                    <div id="div-card-usuarios" class="card shadow-sm border-0 py-4">
                        <div id="div-card-body-usuarios" class="card-body">
                            <i id="icone-card-usuarios" class="fas fa-users fa-3x text-primary mb-3"></i>
                            <h4 id="h4-titulo-usuarios" class="fw-bold">Gerenciar Usuários</h4>
                            <p id="p-desc-usuarios" class="text-muted small">Adicione ou controle acessos.</p>
                            <a id="link-acessar-usuarios" href="usuarios.php" class="btn btn-primary btn-sm px-4">Acessar</a>
                        </div>
                    </div>
                </div>
                <div id="div-col-produtos" class="col-md-4">
                    <div id="div-card-produtos" class="card shadow-sm border-0 py-4">
                        <div id="div-card-body-produtos" class="card-body">
                            <i id="icone-card-produtos" class="fas fa-box fa-3x text-success mb-3"></i>
                            <h4 id="h4-titulo-produtos" class="fw-bold">Gerenciar Produtos</h4>
                            <p id="p-desc-produtos" class="text-muted small">Cadastre preços e imagens web.</p>
                            <a id="produtos" href="produtos.php" class="btn btn-success btn-sm px-4">Acessar</a>
                        </div>
                    </div>
                </div>
                <div id="div-col-vendas" class="col-md-4">
                    <div id="div-card-vendas" class="card shadow-sm border-0 py-4">
                        <div id="div-card-body-vendas" class="card-body">
                            <i id="icone-card-vendas" class="fas fa-receipt fa-3x text-info mb-3"></i>
                            <h4 id="h4-titulo-vendas" class="fw-bold">Visualizar Vendas</h4>
                            <p id="p-desc-vendas" class="text-muted small">Acompanhe os pedidos realizados.</p>
                            <a id="link-acessar-vendas" href="vendas.php" class="btn btn-info btn-sm px-4 text-dark fw-semibold">Acessar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <?php
        if (isset($_GET['logado']) && $_GET['logado'] == 'true') {
            echo "<script>
                Swal.fire({
                    title: 'Bem-vindo!',
                    text: 'Login administrativo realizado com sucesso!',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    ?>
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