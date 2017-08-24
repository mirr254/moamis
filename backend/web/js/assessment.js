$( function() { 

	//this script deals with the automating assessment form
	$('#student-reg_num').change( function(){ 

		var student_reg_number = $('#student-reg_num').val();

		 $.get('index.php?r=assessment/get-student-details',{ student_reg_number : student_reg_number }, function(data){
     	  var data = $.parseJSON(data);

	     	//assign values from the db to the forms	     	
	     	$('#assessment-department_id').attr('value', data.department_id);
	     	  	
     	
         } );

	});
	

});