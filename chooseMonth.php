		<label>Oyni tanlang:</label><br />
		<select name="date">
			<? $current_month = date("m");
				for($i=0;$i<3;$i++){
					$month = $current_month-$i;
					echo "<option value=".$month.">".$month."</option>";
				}				
			?>
		</select><br />
		<input type="submit" value="OK"/>