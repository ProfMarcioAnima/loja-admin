<?php
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div id="div-container-principal" class="container my-5">
        <div id="div-painel-admin" class="painel-admin-box" style="max-width: 600px; margin: auto;">
            <h2 id="h2-titulo-cadastro-usuario" class="fw-bold mb-4"><i id="icone-cadastro-usuario" class="fas fa-user-plus text-primary me-2"></i>Cadastrar Novo Usuário</h2>
            <form id="form-cadastrar-usuario" method="post" action="../controller/usuarioController.php?action=cadastrarUsuario">
                <div id="div-grupo-usuario" class="mb-3">
                    <label id="label-usuario" class="form-label fw-semibold">Login do Usuário</label>
                    <input id="input-usuario" required type="text" name="usuario" class="form-control" placeholder="Digite o login">
                </div>
                <div id="div-grupo-senha" class="mb-4">
                    <label id="label-senha" class="form-label fw-semibold">Senha</label>
                    <input id="input-senha" required type="password" name="senha" class="form-control" placeholder="Digite a senha">
                </div>
                <div id="div-botoes-acao" class="d-flex justify-content-between">
                    <a id="link-voltar" href="usuarios.php" class="btn btn-secondary">Voltar</a>
                    <button id="btn-cadastrar-usuario" type="submit" class="btn btn-primary fw-semibold px-4">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php
    } else {
        header('Location: index.php');
        exit();
    }
?>