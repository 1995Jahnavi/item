function deleteRow(row)
{
    console.log(document.getElementByName('chk'));
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById("stockMovementsTable").deleteRow(i);
    var rowCount = table.rows.length;
        for(var i=0; i<rowCount; i++) 
        {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if(null != chkbox && true == chkbox.checked)
            {
                table.deleteRow(i);
                rowCount--;
                i--;
            }
        }
}

   
function change(){
    var item_select_box = document.getElementById("item-id");
    var unit_select_box=$('#unit-id');                       
  	unit_select_box.empty();      

	$.ajax({
		type: 'get',
		url: '/stock-movements/getunits',
		  data: { 
		    itemid: item_select_box.value
		  },
		   dataType: 'json',
		beforeSend: function(xhr) {
			xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
		},
		success: function(response) 
		{
			if (response.error) {
				alert(response.error);
				console.log(response.error);
			}
			if (response) {			
				for (var k in response) {
					$("#unit-id").append("<option value='" +k+ "'>" +response[k]+ "</option>");
		        }
			}
		  }				
		});	

  } 
  
  function changeCheck(){
          var stock_movement_delete = $('#stock-movement-id');
         
          var checkboxes = document.getElementsByName("chk[]");
          //console.log(checkboxes);
          
	      var checkids = new Array();
	      var checkdelete = new Array();
	     
	    $("input[name='chk[]']:checked").each(function() {
              if ($(this).is(":checked")) {
                 var chkbox = $('#'+$(this).attr('id'));
                 var isnum = /^\d+$/.test($(this).attr('id'));				
 				    if(!isnum)
 				    {
                 
                 	//console.log(chkbox.closest("tr"));
                 	chkbox.closest("tr").remove();
                 }else{
                 	checkids.push($(this).attr('id'));
                 }
              }
                 
              }); 
          
              // console.log(checkid);
	      
	       
	       //return false;
	if(checkids.length > 0){    
	console.log(checkids);   
	$.ajax({
                type:"POST",
                async: true,
                cache: false,
                url: '/stock-movements/getitems',
		        data: { 
					stockmovementid: checkids
                },
		   dataType: 'json',
                beforeSend: function(xhr) {
                    //xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.setRequestHeader('X-CSRF-Token', $('[name="_csrfToken"]').val());
                },
                
               success: function(response) {					
				if (response.error) {
				alert(response.error);
				console.log(response.error);
			}
			if (response){
			   //location.reload();
			   //console.log(response);
//			   $(this).closest('tr').remove();
			   //location.reload();
			   
			   //delete the checkbox closest parent tr
			   checkids.forEach(function(entry) {
				    console.log(entry);
				    var chkbox = $('#'+entry);
				    chkbox.closest("tr").remove();
				});			   
			   
			   }  
           }
        });
        }
      }