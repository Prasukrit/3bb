<?php 

	require_once('Classes/connection_pdo.php'); 
	$db = new DB();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>TDIV DEMO</title>
<script language="JavaScript" type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.js"></script>
<script language="JavaScript" type="text/javascript">
function list(tagNext, val, txtCon) {  
    $.getJSON('combobox.php', {name:txtCon,value:val}, function(data) {
        var select = $(tagNext);
        var options = select.attr('options');
        $('option', select).remove();
           $(select).append('<option value=""> - เลือก - </option>');
        $.each(data, function(index, array) {
                $(select).css("display","inline");
                 $(select).append('<option value="' + array[0] + '">' + array[1] + '</option>');
        });
    });
}
 
</script>
</head>
<body>
<h1>DropDownList</h1>
<form name="formname" method="post" action="">
      <!-- country combobox -->
    <select id="province" name="province" onchange="list('#amPhur',this.value,'province')">
    <?php
    	$sql = "SELECT * FROM tbl_province ORDER BY province_name ASC ";
    	$query = $db->query($sql);
    	$query = $db->bind();
    	$query = $db->execute();
    	$query = $db->fetch();

        foreach ($query as $row_province) {
        	
        
          $id = $row_province["province_id"];
          $name = $row_province["province_name"];
         echo"<option value='$id' selected>$name</option>";
        };
    ?>      
    </select>
      <!-- state combobox is chained by country combobox-->
    <select name="amPhur" id="amPhur" style="display:none" onchange="list('#data', this.value, 'amPhur')"></select>
      <!-- city combobox is chained by state combobox-->
    <select name="data" id="data" style="display:none"></select>
</form>
</body>
</html>