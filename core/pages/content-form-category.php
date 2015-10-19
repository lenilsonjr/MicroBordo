<?php
require_once($_SERVER["DOCUMENT_ROOT"] . '/core/core.php');
?>
<input type="hidden" name="id" value="">

<div class="col-md-9 col-md-offset-1">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<h3 class="panel-title">Categoria</h3>
		</div>

		<div class="panel-body">
			<div class="form-group">
				<label for="name">Titulo da categoria:</label>
	    		<input type="text" class="form-control" name="name" placeholder="Nome da categoria..." required>
			</div>
		</div>
	</div>
</div>
