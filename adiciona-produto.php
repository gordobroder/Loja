<?php 
require_once("cabecalho.php");
require_once("banco-produto.php");
require_once("logica-usuario.php");
require_once("class/Produto.php");
require_once("class/Categoria.php");

verificaUsuario();

$categoria = new Categoria();
$categoria->id = $_POST['categoria_id'];

$produto = new Produto();
$produto->nome = $_POST['nome'];
$produto->preco = $_POST['preco'];
$produto->descricao = $_POST['descricao'];

if(array_key_exists('usado', $_POST)) {
	$produto->usado = "true";
} else {
	$produto->usado = "false";
}

$produto->categoria = $categoria;

if(insereProduto($conexao, $produto)) { ?>
	<p class="text-success">O produto <?= $produto->nome ?>, <?= $produto->preco ?> foi adicionado.</p>
<?php 
} else {
	$msg = mysqli_error($conexao);
?>
	<p class="text-danger">O produto <?= $produto->nome ?> não foi adicionado: <?= $msg?></p>
<?php
}
?>

<?php include("rodape.php"); ?>