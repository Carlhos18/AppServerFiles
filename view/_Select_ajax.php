<option value="">[ SELECCIONE ]</option>
	<?php
		//echo 'cant:'.count($rows); 
		foreach ($rows as $key => $value) { 
			if ($code != $value->$id ) {
	 ?>
	 			<option value="<?php echo $value->$id; ?>"> <?php echo $value->$name ?> </option>
    <?php 	}else { ?>
            	<option selected="selected" value="<?php echo $value->$id; ?>"> <?php echo $value->$name; ?> </option>
    <?php 
			}  
		} 
	?>