<!DOCTYPE html>
<html>
<head>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript">
setInterval(function() {
	var latestid = $("#change div:first-child").attr("id");
   	$.ajax({
	        url: 'ajax.php',
	        data: 'last=' +latestid,
			type: 'POST',
	        cache: false,
	        success: function(response) {
				if(response){
					$('#change').prepend(response);
				}
	        }
	    });
},1000);
</script>
</head>
<body>
	This is a test...
<div id="change"><div class="list" id="0"></div></div>
</body>
</html>