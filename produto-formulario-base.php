<tr>
	<td>Nome</td>
	<td>
		<input class="form-control" type="text" name="nome" 
			value="<?=$produto->setNome?>">
	</td>
</tr>
<tr>
	<td>Preço</td>
	<td>
		<input class="form-control" type="number" step="0.01" name="preco" 
			value="<?=$produto->setPreco?>">
	</td>
</tr>
<tr>
	<td>Descrição</td>
	<td>
		<textarea class="form-control" name="descricao"><?=$produto->setDescricao?></textarea>
	</td>
</tr>
<tr>
	<td></td>
	<td><input type="checkbox" name="usado" <?=$produto->setUsado?> value="true"> Usado
</tr>
<tr>
	<td>Categoria</td>
	<td>
		<select name="categoria_id" class="form-control">
			<?php
			foreach($categorias as $categoria) : 
				$essaEhACategoria = $produto->categoria->id == $categoria->id;
				$selecao = $essaEhACategoria ? "selected='selected'" : "";
			?>
				<option value="<?=$categoria->id?>" <?=$selecao?>>
					<?=$categoria->nome?>
				</option>
			<?php 
			endforeach
			?>
		</select>
	</td>
</tr>