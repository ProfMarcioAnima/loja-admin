<?php
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários - Admin</title>
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
                <a id="link-nav-produtos" href="produtos.php" class="btn btn-outline-light me-2"><i id="icone-nav-produtos" class="fas fa-box me-1"></i> Produtos</a>
                <a id="link-nav-vendas" href="vendas.php" class="btn btn-outline-info me-3"><i id="icone-nav-vendas" class="fas fa-receipt me-1"></i> Vendas</a>
                <a id="link-nav-sair" href="#" onclick="confirmSair()" class="btn btn-danger"><i id="icone-nav-sair" class="fas fa-sign-out-alt me-1"></i> Sair</a>
            </div>
        </div>
    </nav>

    <div id="div-container-principal" class="container my-5">
        <div id="div-painel-admin" class="painel-admin-box">
            <div id="div-cabecalho-usuarios" class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h2 id="h2-titulo-usuarios" class="fw-bold m-0"><i id="icone-titulo-usuarios" class="fas fa-users text-primary me-2"></i>Gerenciamento de Usuários</h2>
                <a id="link-novo-usuario" href="cadastrarUsuario.php" class="btn btn-primary fw-semibold"><i id="icone-novo-usuario" class="fas fa-plus me-1"></i> Novo Usuário</a>
            </div>

            <div id="div-tabela-usuarios" class="table-responsive">
                <table id="tabela-usuarios" class="table table-hover align-middle">
                    <thead id="thead-usuarios" class="table-light">
                        <tr id="tr-cabecalho-usuarios">
                            <th id="th-id-usuario">ID</th>
                            <th id="th-login-usuario">LOGIN</th>
                            <th id="th-criado-usuario">CRIADO EM</th>
                            <th id="th-editar-usuario" class="text-center">EDITAR</th>
                            <th id="th-excluir-usuario" class="text-center">EXCLUIR</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-usuarios">
                        <?php
                            require_once('../controller/usuarioController.php');
                            $usuario = new Usuario();
                            $consulta = $usuario->consulta();

                            foreach ($consulta as $linha) {
                                $id = $linha['id_usuario'];
                                $login = $linha['usuario'];
                                $criado = $linha['data_criado'];

                                echo "
                                <tr id='tr-usuario-$id'>
                                    <td id='td-id-usuario-$id'>#$id</td>
                                    <td id='td-login-usuario-$id' class='fw-semibold'>$login</td>
                                    <td id='td-criado-usuario-$id' class='text-muted'>$criado</td>
                                    <td id='td-editar-usuario-$id' class='text-center'><a id='btn-editar-usuario-$id' class='btn btn-success btn-sm' href='editarUsuario.php?id=$id'><i id='icone-editar-usuario-$id' class='fas fa-edit'></i></a></td>
                                    <td id='td-excluir-usuario-$id' class='text-center'><a id='btn-excluir-usuario-$id' class='btn btn-danger btn-sm' onclick='confirmDelete($id)' href='#'><i id='icone-excluir-usuario-$id' class='fas fa-trash'></i></a></td>
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
        function confirmDelete(id) {
            Swal.fire({
                title: "Você tem certeza?",
                text: "Não será possível reverter essa ação!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#c00",
                cancelButtonColor: "#aaa",
                cancelButtonText: "Cancelar!",
                confirmButtonText: "Apagar!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `../controller/usuarioController.php?id=${id}&action=excluirUsuario`;
                }
            });
        }

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