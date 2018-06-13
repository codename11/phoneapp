function delRec(phpdoc,tab,me){
	
	var tabBox = tab.querySelectorAll("#"+tab.id+" [type=checkbox]");//Gathers all checkboxes.
	var tabLen = tabBox.length;//Counts how many checkboxes are currently displayed.
	var table=document.getElementById(tab.id);//Gets table id.
	var rowLen = table.rows[0].cells.length;//Counts how many columns are in any given row. Since all rows are the same, i used first one for this counting.
	var arr = []; //Array used for storage of data gathered from one row per one array element.
	var str = "";//String that is used as temp. storage of column contents.

	var obj = {//An JS object for stringification.
			"id" : [],
		};
	
	var tmp1=null;
	var tmp2="";
	for(var i=0;i<tabLen;i++){//Traversing through table rows.
		
		for(var j=1;j<(rowLen);j++){//Traversing through row's columns.
		
			if(tabBox[i].checked===true){//If checked only then is added content from table row.

				arr[i] = tabBox[i].value;
			
			}

		}

	}
	
	arr = arr.filter(function(n){ return n != "" });//Filter duplicates leaving only one of each. It filters only empty array elements, then rearranges array.
	
	var arrx = [];//A temporary array for each cell's individual content.
	var arrxLen = 0;//Length of said array, not yet determined.
	for(var i=0;i<arr.length;i++){//Itteration through array with row/columns content.Previously mentioned array
		
		//Assigning values to each element of temp array from current element of previous array to JS object. 
		obj.id[i] = arr[i];
		
	}
	
	var xhttp = new XMLHttpRequest();
			
	xhttp.onreadystatechange = function() {
		
		if(this.readyState == 4 && this.status == 200){
			console.log(this.responseText);
			//document.getElementById(formax.id).reset(); 
			
			for(var i=0;i<tabLen;i++){//Traversing through table rows.
		
				if(tabBox[i].checked===true){//If checked only then is added content from table row.
					tabBox[i].closest("tr").remove();
					//document.getElementById(tab.id).deleteRow(i+1);
				}
					
			}

		}
		 
	};

	var jason = JSON.stringify(obj);//Stringification of an object.

	xhttp.open("GET", phpdoc+"?jason="+jason,true);//Sending stringified json.
	xhttp.setRequestHeader("Content-Type", "application/json");//A header need for server to understend what kind a data has been sent to.
	xhttp.send();
	
}

$(document).ready(function(){
    $("#forma1").submit(function(event){
		event.preventDefault();//Use this if you want your fields to stay populated after submition.

		$.ajax({
			url: "upis.php",//Where to send data.
			type: "GET",//POST or GET
			contentType: "text/html",//Regular html format
			data: $("#forma1").serialize(),//For displaying use this: print_r($_GET);
			success:function(result){
				$("#raport").html(result);//Display in div with id=raport.
			},
			error: function () {//In case of an error
				alert("Error!!!");
			}

		});
	});
	
	$("#forma2").submit(function(event){
		event.preventDefault();//Use this if you want your fields to stay populated after submition.

		$.ajax({
			url: "display.php",//Where data to send.
			type: "GET",//POST or GET
			contentType: "text/html",//Regular html format
			data: $("#forma2").serialize(),//For displaying use this: print_r($_GET);
			success:function(result){
				
				console.log(result);
				var myObj = JSON.parse(result);

				var txt = "<div class='container'><table id='tabela' class='table table-hover table-bordered table-sm'><thead><tr><th class='text-center'>Table row index</th><th class='text-center'>First Name</th><th class='text-center'>Last Name</th><th class='text-center'>Number</th></tr></thead><tbody>";
				var len = myObj.FirstName.length;
					
				for (var i=0;i<len;i++) {
					txt += "<tr><td class='text-center'>"+i+". <input type='checkbox' class='form-check-input' value='"+myObj.id[i]+"'>"+"</td><td class='text-center'>"+myObj.FirstName[i]+"</td><td class='text-center'>"+myObj.LastName[i]+"</td><td>"+myObj.number[i]+"</td>";

				}
				txt += "</tr></tbody></table></div><button id='btndel' type='button' class='btn btn-danger' onclick='delRec("+'"delete.php"'+",tabela,this)'>Delete</button>"
				
				$("#raport").html(txt);//Display in div with id=raport.
			
			},
			error: function () {//In case of an error
				alert("Error!!!");
			}

		});
	});
	
	

	$(function(){ //Set active class when page is changed.
		var current_page_URL = location.href;
		$( "a" ).each(function() {
			if ($(this).attr("href") !== "#") {
					
			var target_URL = $(this).prop("href");
					
				if (target_URL == current_page_URL) {
					$('.nav a').parents('li, ul').removeClass('active');
					$(this).parent('li').addClass('active');
					return false;
				}
					
			}
		});
	}); 
	
});



	
	