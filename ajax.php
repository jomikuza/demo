<?php




?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="scripts/jquery-1.8.3.js"></script>
</head>
<body>

<h1>My First Heading</h1>
<div>
<a href="javascript:;" class="like">5</a>
<a href="javascript:;" class="like">7</a>
<a href="javascript:;" class="like">9</a>
</div>
<div id="likes">

</div>
<div id="cantLikes">0</div>
<script type="text/javascript">
$( document ).ready(function() {

	$(".like").click(function(){	
				
		var i = $(this).text();
		getLikes(i);
	});

	function getLikes(i) {
		$.ajax("constraints/application/controller/noticiaController.php", {
			   "type": "post",   // usualmente post o get
			   "success": function(result) {
			    // console.log(result);	
				if(result) {
							     
			     var json = $.parseJSON(result);			     
			     console.log(json.mensaje);
			     console.log(json.error);
			     console.log(json.id);
			     console.log(json.nombre);
			     console.log(json.apellidoP);
			     console.log(json.rut);
			     console.log(json.dv);	
			     populateLikes(json);
			     		     
				}else {
			     console.log("vacio"); 					
				}	
					     
			   },
			   "error": function(result) {
			     console.error("Este callback maneja los errores", result);
			   },
			   "data": {id: i, ajax: true, f: 1},
			   "async": true,
		});		
	}


	function populateLikes(json) {
		$("#likes").text(json.id);
		$("#cantLikes").text(json.likes);
		
	}

		
	function populatePerson(json) {
		
		var persona = new Object();
		persona.id = json.id;
		persona.nombre = json.nombre;
		persona.sumar = function () {
			this.id = (this.id + 1);
			 return false;
		};
	
		console.log(persona instanceof Object);
		console.log(persona);
		console.log(persona.id);
		console.log(persona.sumar());
		console.log(persona.id);
	}
});
</script>
</body>
</html>