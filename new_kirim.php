<link href="style/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="assets/css/styles.css" />
<link href="style/css/layout.css" rel="stylesheet" type="text/css" />
<link href="style/css/modal.css" rel="stylesheet" type="text/css" />
	<br />
		<table align="center" style="width:500px;">	<tr>	<td>
		<h3 class='headline3'>Yangi kirim qo`shish</h3>
		 <form action="add_kirim.php" method="post" name="form_kirim" id="questions">
		 	<p><label>Kategoriya:</label><br><select name="cat_k">
			<option value=''></option>
			<?
			include("blocks/bd.php"); 
			$result13 = mysql_query("SELECT priz,name FROM cat WHERE priz='1'");
			$myrow13 = mysql_fetch_array($result13);
				do{
					printf("<option value='%s'>%s</option>",$myrow13["name"],$myrow13["name"]);
				}while($myrow13 = mysql_fetch_array($result13));
			?>
			 </select> 

            <span class="panel">
                <a href="#join_form" id="join_pop">Yangi</a>
            </span>


			 </p>
			<p><label>Ost Kategoriya:</label><br><select name="podcat_k">
			<option value=''></option>
			<?
			$result14 = mysql_query("SELECT priz,name FROM pod_cat WHERE priz='1'");
			$myrow14 = mysql_fetch_array($result14);
				do{
					printf("<option value='%s'>%s</option>",$myrow14["name"],$myrow14["name"]);
				}while($myrow14 = mysql_fetch_array($result14));
			?></select>
			<span class="panel">
                <a href="#join_form1" id="join_pop">Yangi</a>
            </span>
			</p>
			<p><label>Soni:</label> <br><input type="text" name="soni"/></p>
			<p><label>Summa:</label> <br><input type="text" name="sum_k"/></p>
			<p><label>Qo`shimcha:</label> <br><textarea name="primech" cols="32" rows="4"></textarea></p>
			<p><label>Sana:</label> <br><input type="text" name="date"/></p>
			<p><input name="sub_com" type="submit" value="Daromad qo`shish" />
			<button><a href="kirim.php" style="text-decoration:none">Orqaga</a>	</button>
			</p>
		 </form>
		 <a href="#x" class="overlay" id="join_form"></a>
        <div class="popup">
		<form action="addCat.php" method="post" name="form_com" id="insert_com">
            <h2>Yangi kirim Kategoriyasini qo`shish</h2>

            <div>
                <label for="kat">Kategoriya nomi</label>
                <input type="text" id="name" name="name" value="" />
				<input type="hidden" name="priz" value="1"/>				
            </div>
			<input type="submit" value="Qo`shish"/>

            <a class="close" href="#close"></a>
		</form>			
        </div>
		
		<a href="#x" class="overlay" id="join_form1"></a>
        <div class="popup">
		<form action="addPodCat.php" method="post" >
            <h2>Kategoriya bo`yicha Ost kategoriya qo`shish</h2>

            <div>
                <label for="kat">Ost kategoriya nomi</label>
                <input type="text" id="name" name="name" value="" />
				<input type="hidden" name="priz" value="1"/>
				<p><label>Kategoriya:</label><br><select name="cat_k">
			<option value=''></option>
			<?
			$result13 = mysql_query("SELECT priz,name FROM cat WHERE priz='1'");
			$myrow13 = mysql_fetch_array($result13);
				do{
					printf("<option value='%s'>%s</option>",$myrow13["id"],$myrow13["name"]);
				}while($myrow13 = mysql_fetch_array($result13));
			?>
			 </select> 
            </div>
			<input type="submit" value="Qo`shish"/>
            <a class="close" href="#close"></a>
		</form>			
        </div>
		</td>	
		</tr>	
		</table>