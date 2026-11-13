<?php
    session_start();
    if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <div id="div-container-principal" class="container my-5">
        <div id="div-painel-admin" class="painel-admin-box" style="max-width: 600px; margin: auto;">
            <h2 id="h2-titulo-cadastro" class="fw-bold mb-4"><i id="icone-cadastro" class="fas fa-plus-circle text-success me-2"></i>Cadastrar Novo Produto</h2>
            <form id="form-cadastrar-produto" method="post" action="../controller/produtoController.php?action=cadastrarProduto">
                <div id="div-grupo-nome" class="mb-3">
                    <label id="label-nome" class="form-label fw-semibold">Nome do Produto</label>
                    <input id="input-nome" required type="text" name="nome" class="form-control" placeholder="Nome">
                </div>
                <div id="div-grupo-descricao" class="mb-3">
                    <label id="label-descricao" class="form-label fw-semibold">Descrição</label>
                    <textarea id="textarea-descricao" name="descricao" class="form-control" rows="3" placeholder="Descrição"></textarea>
                </div>
                <div id="div-grupo-preco" class="mb-3">
                    <label id="label-preco" class="form-label fw-semibold">Preço (R$)</label>
                    <input id="input-preco" required type="number" step="0.01" name="preco" class="form-control" placeholder="0.00">
                </div>
                <div id="div-grupo-imagem" class="mb-4">
                    <label id="label-imagem" class="form-label fw-semibold">Link da Imagem (URL da Internet)</label>
                    <input id="input-imagem" type="url" name="imagem" class="form-control" placeholder="https://exemplo.com/foto.jpg">
                </div>
                <div id="div-botoes-acao" class="d-flex justify-content-between">
                    <a id="link-voltar" href="produtos.php" class="btn btn-secondary">Voltar</a>
                    <button id="btn-cadastrar" type="submit" class="btn btn-success fw-semibold px-4">Cadastrar Produto</button>
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