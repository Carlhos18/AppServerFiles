<form id="frmpermisos" name="frmpermisos" action="">
	<input name="idperfil" id="idperfil" type="hidden" value="<?php echo $idperfil;?>">
	<table width="100%" style="border:1px solid #666; font-size:13px; margin-bottom:3px;" align="center">
		
		<?php
		$c=0;
		//print_r($mod);
		foreach($mod as $valor)
		{
			$c=$c+1;
			if($valor['pm_id']==""){ $valor['pm_id']=0;}
			if($valor['pm_acceder']==1){$checka="checked='checked'";}else  {$checka="";}
			if($valor['pm_modificar']==1){$checkm="checked='checked'";}else  {$checkm="";}
			if($valor['pm_eliminar']==1){$checke="checked='checked'";}else  {$checke="";}
			if($valor['pm_insertar']==1){$checki="checked='checked'";}else  {$checki="";}
			//if($valor['pm_directo']==1){$checkc="checked='checked'";}else  {$checkc="";}
		?>
			<tr style='border-bottom:1px solid #666; background:#F5F5F5' 
					onMouseOver="this.style.backgroundColor='#CCC';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#F5F5F5'"o"];" >
				<td>
					<input type='hidden' name="codigo[]" id="codigo[]" value="<?php echo $valor['m_id']?>"/>
					<input type='hidden' name="pm_id[]" id="pm_id[]" value="<?php echo $valor['pm_id']?>" />
					<?php echo str_pad($c , 2 , "0", 0); ?>.<b><?php echo $valor['texto']?></b>
				</td>
				<td align="center">
					<input type="checkbox" name="pm_acceder[]" id="pm_acceder[]" <?php echo $checka;?>/>
				</td>
				<td align="center">
					<input type="checkbox" name="pm_insertar[]" id="pm_insertar[]"  <?php echo $checki;?>/>
				</td>
				<td align="center"> 
					<input type="checkbox" name="pm_modificar[]" id="pm_modificar[]"  <?php echo $checkm;?>/>
				</td>
				<td align="center">
					<input type="checkbox" name="pm_eliminar[]" id="pm_eliminar[]" <?php echo $checke;?>/>
				</td>

			</tr>
			<?php
			$d = 0;
			foreach($valor['hijos'] as $valor2)
			{
				if($valor2['pm_id']==""){ $valor2['pm_id']=0;}
				if($valor2['pm_acceder']==1){$checkaa="checked='checked'";}else  {$checkaa="";}
				if($valor2['pm_modificar']==1){$checkmm="checked='checked'";}else  {$checkmm="";}
				if($valor2['pm_eliminar']==1){$checkee="checked='checked'";}else  {$checkee="";}
				if($valor2['pm_insertar']==1){$checkii="checked='checked'";}else  {$checkii="";}
				$d++;
			?>
			<tr style='border-bottom:1px solid #666; background:#F5F5F5' 
				onMouseOver="this.style.backgroundColor='#CCC';this.style.cursor='hand';" onMouseOut="this.style.backgroundColor='#F5F5F5'"o"];" >
				<td>
					&nbsp;&nbsp;&nbsp;
					<input type='hidden' name='codigo[]' id="codigo[]" value="<?php echo $valor2['m_id']?>" />
					<input type='hidden' name="pm_id[]" id="pm_id[]" value="<?php echo $valor2['pm_id']?>" />
					<?php echo $c.".".$d." "; ?>.<?php echo $valor2['texto']?>
				</td>
				<td align="center">
					<input type="checkbox" name="pm_acceder[]" id="pm_acceder[]" <?php echo $checkaa;?>/>
				</td>
				<td align="center">
					<input type="checkbox" name="pm_insertar[]" id="pm_insertar[]" <?php echo $checkii;?>/>
				</td>
				<td align="center">
					<input type="checkbox" name="pm_modificar[]" id="pm_modificar[]"  <?php echo $checkmm;?>/>
				</td>
				<td align="center">
					<input type="checkbox" name="pm_eliminar[]" id="pm_eliminar[]"<?php echo $checkee;?>/>
				</td>

			</tr>
			<?php
			}
		}
		?>
	</form>