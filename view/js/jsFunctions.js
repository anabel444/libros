$(document).ready(function(){
	
  	$.ajax({
  
       	url: "controller/controller_index.php", 
    	datatype: "json",  //type of the result
       	
    	success: function(result){ 
    		
    		console.log("LIBROS"+result);
       		var books = JSON.parse(result);

       		$("#container").empty(); // removes all the previous content in the container
       		
       		var newRow ="<br/><h2>Titulos biblioteca</h2><br/>";
  			newRow +="<table > ";
			newRow +="<tr><th>ID</th><th>TITULO</th><th>AUTOR</th><th>NUMPAG</th>" +
					"<th>EDITORIAL</th><th>CIUDAD</th></tr>";
       		
			$.each(books,function(index,info) { 
				
				newRow += "<tr>" +"<td>"+info.id+"</td>"
									+"<td>"+info.titulo+"</td>"
									+"<td>"+info.autor+"</td>"
									+"<td>"+info.numPag+"</td>"
									+"<td><button  class='btnEditorial' value='"+info.idEditorial+"'>"+info.objectEditorial.nombreEditorial+"</button></td>"
									+"<td>"+info.objectEditorial.ciudad+"</td>"
							+"</tr>"	
        	});
       		newRow +="</table>";   // Cliente aldean geratzen da bakarrik/ solo se queda en el DOM del cliente
       		
       		$("#container").append(newRow); // add the new row to the container
       		
       		
       		//btnEditorial click egiten, SUCCESS honen barruan, kanpoan botoia EZ DA EXISTITZEN
       		//Hay que poner aqui el click del btnEditorial porque se ha creado AQUI, fuera NO EXISTE
       		$(".btnEditorial").click(function(){
       			
       			var idEditorial=$(this).val();
       			
	       		$.ajax({
	       			type:"GET",
	       			data:{'idEditorial':idEditorial},
	       	       	url: "controller/controller_listLibrosEditorial.php", 
	       	    	datatype: "json",  //type of the result
	       	       	
	       	    	success: function(result){ 
	       	    		
	       	    		console.log("LIBROS EDITORIAL"+result);
	       	    		
	       	       		var books = JSON.parse(result);
	       	       		
	       	       		//location.href='view/librosEditorial.php';
	       	       		
	       	       		$("#container2").empty(); // removes all the previous content in the container
	       	       		
	       	       		var newRow ="<br/><h2>Libros editorial "+ books.idEditorial+"</h2><br/>";
	       	  			newRow +="<table > ";
	       				newRow +="<tr><th>ID</th><th>TITULO</th><th>AUTOR</th><th>NUMPAG</th></tr>";
	       	       		
	       				$.each(books,function(index,info) { 
	       					
	       					newRow += "<tr>" +"<td>"+info.id+"</td>"
	       										+"<td>"+info.titulo+"</td>"
	       										+"<td>"+info.autor+"</td>"
	       										+"<td>"+info.numPag+"</td>"
	       								+"</tr>"	
	       	        	});
	       	       		newRow +="</table>";   // Cliente aldean geratzen da bakarrik/ solo se queda en el DOM del cliente
	       	       		
	       	       		$("#container").append(newRow); // add the new row to the container
		       	    	},
		       	       	error : function(xhr) {
		       	   			alert("An error occured: " + xhr.status + " " + xhr.statusText);
		       	   		}
	       	    	});
       		});
    	},
       	error : function(xhr) {
   			alert("An error occured: " + xhr.status + " " + xhr.statusText);
   		}
    });
  	$.ajax({
	       	type:"GET",
	       	url: "controller/controller_listEditoriales.php", 
	    	datatype: "json",  //type of the result
	       	
	    	success: function(result){  
	    		
	    		console.log("EDITORIALES"+result);
	    		
	       		var editorials = JSON.parse(result);
	       		
	       		console.log(result);
	       		$("#idEditorial").empty(); // removes all the previous content in the container
	       		
	       		var newRow ="<option>--Select--></option>";

				$.each(editorials,function(index,info) { 
			  	
					newRow +="<option value='"+info.idEditorial+"'>"+ info.nombreEditorial+"</option>"; 
		     
				});
		
				$("#idEditorial").append(newRow); // add the new option to the select
	    	},
	       	error : function(xhr) {
	   			alert("An error occured: " + xhr.status + " " + xhr.statusText);
	   		}
		});
	
		$("#btnInsert").click(function(){
			
			var titulo=$("#titulo").val();
			var autor=$("#autor").val();
			var numPag=$("#numPag").val();
		     
		  	$.ajax({
		       	type: "GET",
		       	data:{ 'titulo':titulo, 'autor':autor,'numPag':numPag},
		       	url: "controller/controller_insert.php", 
		       	datatype: "json",  //type of the result
		       	success: function(result){  
		       		
		       		console.log(result);
		       		alert(result);
		       		location.reload(true);  //recarga la pagina
		       	},
		       	error : function(xhr) {
		   			alert("An error occured: " + xhr.status + " " + xhr.statusText);
		   		}
		       });
	  	
	    });
});