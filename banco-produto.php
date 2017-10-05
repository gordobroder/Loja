<?php
require_once("conecta.php");
require_once("class/Produto.php");
require_once("class/Categoria.php");

function listaProdutos($conexao) {

	$produtos = array();
	$resultado = mysqli_query($conexao, "select p.*,c.nome as categoria_nome 
		from produtos as p join categorias as c on c.id=p.categoria_id");

	while($produto_array = mysqli_fetch_assoc($resultado)) {

		$categoria = new Categoria();
		$categoria->getNome = $produto_array['categoria_nome'];

		$produto = new Produto();
		$produto->getId = $produto_array['id'];
		$produto->getNome = $produto_array['nome'];
		$produto->getDescricao = $produto_array['descricao'];
		$produto->getCategoria = $categoria->getNome;
		$produto->getPreco = $produto_array['preco'];
		$produto->getUsado = $produto_array['usado'];

		array_push($produtos, $produto);
	}

	return $produtos;
}

function insereProduto($conexao, Produto $produto) {

	$query = "insert into produtos (nome, preco, descricao, categoria_id, usado) 
		values ('{$produto->nome}', {$produto->preco}, '{$produto->descricao}', 
			{$produto->categoria->id}, {$produto->usado})";

	return mysqli_query($conexao, $query);
}

function alteraProduto($conexao, Produto $produto) {

	$query = "update produtos set nome = '{$produto->nome}', 
		preco = {$produto->preco}, descricao = '{$produto->descricao}', 
			categoria_id= {$produto->categoria->id}, usado = {$produto->usado} 
				where id = '{$produto->id}'";

	return mysqli_query($conexao, $query);
}

function buscaProduto($conexao, Produto $produto) {

	$query = "select * from produtos where id = {$produto->getId}";
	$resultado = mysqli_query($conexao, $query);
	$produto_buscado = mysqli_fetch_assoc($resultado);
	var_dump($produto_buscado);
	$categoria = new Categoria();
	$categoria->getId = $produto_buscado['categoria_id'];

	$produto = new Produto();
	$produto->getId = $produto_buscado['id'];
	$produto->getNome = $produto_buscado['nome'];
	$produto->getDescricao = $produto_buscado['descricao'];
	$produto->getCategoria = $categoria;
	$produto->getPreco = $produto_buscado['preco'];
	$produto->getUsado = $produto_buscado['usado'];

	return $produto;
}

function removeProduto($conexao, $id) {

	$query = "delete from produtos where id = {$id}";

	return mysqli_query($conexao, $query);
}