<?php

$msg = '';
if (isset($_POST['title'])){
	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "testdb;";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password,$db);

	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	$e = array();
	$level = 'district';
	// validation
	if (empty($_POST['title'])){
		$e[] = 'title ไม่ถูกต้อง';
	}
	if (empty($_POST['district_id'])){
		if (empty($_POST['amphur_id'])){
			if (empty($_POST['province_id'])){
				$e[] = 'ไม่ได้ระบุจังหวัด';
			}
			$e[] = 'ไม่ได้ระบุอำเภอ';
			$e[] = 'ไม่ได้ระบุตำบล';
		} else {
			$amphur_id = intval($_POST['amphur_id']);
			$sql = "SELECT count(*) FROM tbl_amphur WHERE AMPHUR_ID=$amphur_id";
			$result = mysqli_query($conn, $sql);
			if (mysqli_result($result,0)==0){
				$e[] = 'อำเภอไม่ถูกต้อง';
			} else {

				$sql = "SELECT count(*) FROM tbl_district WHERE AMPHUR_ID=$amphur_id";
				$result = mysqlii_query($conn, $sql);
				if (mysqli_result($result,0)>0){
					$e[] = 'ยังไม่ได้ระบุตำบล';
				} else {
					$level = 'amphur';
					//ไม่จำเป็นต้องระบตำบลเพราะอำเภอไม่มีตำบล
				}
			}
		}
	} else {
		$district_id = intval($_POST['district_id']);
		$sql="SELECT count(*) FROM tbl_district WHERE DISTRICT_ID = $district_id";
		$result = mysqli_query($conn, $sql);
		if (mysqli_result($result,0)==0){
			$e[] = 'ตำบลไม่ถูกต้อง';
		}
	}
	if (count($e)>0){
		$msg = '<div id="error">'.implode('<br />',$e).'</div>';
	} else {
		$msg = "<div id=\"notice\">valid at level : $level</div>";
		$district_value = 0;
		if ($level == 'district'){
			$sql = "SELECT * FROM tbl_district WHERE DISTRICT_ID=$district_id";
			$result = mysqli_query($conn, $sql);
			$district_value = $district_id;
			$amphur_value = mysqli_result($result,0,'AMPHUR_ID');
			$province_value = mysqli_result($r,0,'PROVINCE_ID');
		} else {
			$sql = "SELECT * FROM tbl_amphur WHERE AMPHUR_ID=$amphur_id";
			$result = mysqli_query($conn , $sql);
			$amphur_value = mysqli_result($r,0,'AMPHUR_ID');
			$province_value = mysqli_result($r,0,'PROVINCE_ID');
		}
		//insert province_value,amphur_value,district_value and title into some table
	}
}
function textbox($name){
        global $_POST;
        echo isset($_POST[$name])?htmlspecialchars($_POST[$name]):'';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="th" xml:lang="th">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="Author" content="num, dragon_html[at]hotmail.com" />
	<title>combobox เลือก จังหวัด ตำบล อำเภอ โดยใช้ jquery</title>
<style type="text/css">
/*<![CDATA[*/
#error {color:red}
#notice {color:green}
/*]]>*/
</style>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript">
//<![CDATA[

var province_id = <?php echo isset($_POST['province_id']) ? intval($_POST['province_id']) : '0'; ?>;
var amphur_id = <?php echo isset($_POST['amphur_id']) ? intval($_POST['amphur_id']) : '0'; ?>;
var district_id = <?php echo isset($_POST['district_id']) ? intval($_POST['district_id']) : '0'; ?>;

function loadSelectBox(id,url,selected){
	$.get(
		url,{},function(data){
			$(id).html(data);
			if (selected!=0){
				$(id+' option[value='+selected+']').attr('selected','selected');
			}
		}
	);
}

$(function(){
	loadSelectBox(
			'#province_id',
			'geo_combo.php?load=province',
			province_id
	);
	loadSelectBox(
			'#amphur_id',
			'geo_combo.php?load=amphur&province_id='+province_id,
			amphur_id
	);
	loadSelectBox(
			'#district_id',
			'geo_combo.php?load=district&amphur_id='+amphur_id,
			district_id
	);
	$('#province_id').change(function(e){
		var selected = e.target.value;
		loadSelectBox(
			'#amphur_id',
			'geo_combo.php?load=amphur&province_id='+selected,
			0
		);
		$('#district_id :not(option:first)').remove(); //add
	});
	$('#amphur_id').change(function(e){
		var selected = e.target.value;
		loadSelectBox(
			'#district_id',
			'geo_combo.php?load=district&amphur_id='+selected,
			0
		);
	});
});
//]]>
</script>
</head>
<body>

<h1>combobox เลือกจังหวัด อำเภอ และตำบล โดยใช้ jquery</h1>

<?php echo $msg;?>

<form action="?" method="post">
	news <input type="text" name="title" value="<?php textbox('title');?>" />
	<br />จังหวัด <select id="province_id" name="province_id">
            <option value="0">-- เลือกจังหวัด --</option>
        </select>
	<br />อำเภอ <select id="amphur_id" name="amphur_id">
            <option value="0">-- เลือกอำเภอ --</option>
        </select>
	<br />ตำบล <select id="district_id" name="district_id">
            <option value="0">-- เลือกตำบล --</option>
        </select>
	<br /> <input type="submit" value="submit" />
</form>

</body>
</html>