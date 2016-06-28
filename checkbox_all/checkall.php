<!DOCTYPE html>
<html>
<head>
<style>
	ul li ul{padding-left:15px;}
</style>
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-1.12.3.js"></script>
<script>

$(document).ready(function(){
	var buttoncheck = document.getElementById('button-check');

	var checker = document.getElementById('checkme');
	$('#general i .counter').text(' ');

	

	var fnUpdateCount = function() {
		var generallen = $("#general-content input[name='checkboxlist[]']:checked").length;
	    console.log(generallen,$("#general i .counter") )


		if (generallen > 0) {
			$("#general i .counter").text('(' + generallen + ')');


		} else {
			$("#general i .counter").text(' ');
		}
	};

	$("#general-content input:checkbox").on("change", function() {
				fnUpdateCount();
			});

	
	$('.check_all').change(function() {
				var checkthis = $(this);
				var checkboxes = $("#general-content input:checkbox");

				if (checkthis.is(':checked')) {
					checkboxes.prop('checked', true);
				} else {
					checkboxes.prop('checked', false);
				}
	            fnUpdateCount();
			});
	});
</script>
</head>
<body>


<input type="checkbox" class="check_all" />Select All <br />
<div id="general-content">
    <input type="checkbox" id="checkme" name="checkboxlist[]" value="1" /><br />
    <input type="checkbox" id="checkme" name="checkboxlist[]" value="2" /><br />
    <input type="checkbox" id="checkme" name="checkboxlist[]" value="3" /><br />
    <input type="checkbox" id="checkme" name="checkboxlist[]" value="4" /><br />
</div>
<input type="submit" id="button-check" >
<div id="general">
<i>
    <span class="counter"></span>
</i>
</div>
</body>
</html>