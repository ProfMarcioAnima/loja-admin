<?php
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Produtos - Admin</title>
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
                <a id="link-nav-vendas" href="vendas.php" class="btn btn-outline-info me-3"><i id="icone-nav-vendas" class="fas fa-receipt me-1"></i> Vendas</a>
                <a href="#" id="sair" onclick="confirmSair()" class="btn btn-danger"><i id="icone-nav-sair" class="fas fa-sign-out-alt me-1"></i> Sair</a>
            </div>
        </div>
    </nav>

    <div id="div-container-principal" class="container my-5">
        <div id="div-painel-admin" class="painel-admin-box">
            <div id="div-cabecalho-produtos" class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                <h2 id="h2-titulo-produtos" class="fw-bold m-0"><i id="icone-titulo-produtos" class="fas fa-box text-success me-2"></i>Gerenciamento de Produtos</h2>
                <a id="link-novo-produto" href="cadastrarProduto.php" class="btn btn-success fw-semibold"><i id="icone-novo-produto" class="fas fa-plus me-1"></i> Novo Produto</a>
            </div>

            <div id="div-tabela-produtos" class="table-responsive">
                <table id="tabela-produtos" class="table table-hover align-middle">
                    <thead id="thead-produtos" class="table-light">
                        <tr id="tr-cabecalho-produtos">
                            <th id="th-foto">FOTO</th>
                            <th id="th-id">ID</th>
                            <th id="th-nome">NOME</th>
                            <th id="th-descricao">DESCRIÇÃO</th>
                            <th id="th-preco">PREÇO</th>
                            <th id="th-editar" class="text-center">EDITAR</th>
                            <th id="th-excluir" class="text-center">EXCLUIR</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-produtos">
                        <?php
                            require_once('../controller/produtoController.php');
                            $produto = new Produto();
                            $consulta = $produto->consulta();

                            foreach ($consulta as $linha) {
                                $id = $linha['id'];
                                $nome = $linha['nome'];
                                $descricao = $linha['descricao'];
                                $preco = number_format($linha['preco'], 2, ',', '.');
                                $imagem = $linha['imagem'];
                        ?>
                        <tr id="tr-produto-<?php echo $id; ?>">
                            <td id="td-foto-<?php echo $id; ?>">
                                <?php if (!empty($imagem)) { ?>
                                    <img id="img-produto-<?php echo $id; ?>" src="<?php echo htmlspecialchars($imagem); ?>" class="img-admin-preview" alt="Foto">
                                <?php } else { ?>
                                    <span id="span-sem-foto-<?php echo $id; ?>" class="badge bg-secondary">Sem Foto</span>
                                <?php } ?>
                            </td>
                            <td id="td-id-<?php echo $id; ?>">#<?php echo $id; ?></td>
                            <td id="td-nome-<?php echo $id; ?>" class="fw-semibold"><?php echo $nome; ?></td>
                            <td id="td-descricao-<?php echo $id; ?>" class="text-muted small"><?php echo $descricao; ?></td>
                            <td id="td-preco-<?php echo $id; ?>" class="fw-bold text-success">R$ <?php echo $preco; ?></td>
                            <td id="td-editar-<?php echo $id; ?>" class="text-center"><a id="produto<?php echo $id; ?>" class='btn btn-success btn-sm' href='editarProduto.php?id=<?php echo $id; ?>'><i id="icone-editar-<?php echo $id; ?>" class='fas fa-edit'></i></a></td>
                            <td id="td-excluir-<?php echo $id; ?>" class="text-center"><a id="btn-excluir-<?php echo $id; ?>" class='btn btn-danger btn-sm' onclick='confirmDelete(<?php echo $id; ?>)' href='#'><i id="icone-excluir-<?php echo $id; ?>" class='fas fa-trash'></i></a></td>
                        </tr>
                        <?php } ?>
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
                    window.location.href = `../controller/produtoController.php?id=${id}&action=excluirProduto`;
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