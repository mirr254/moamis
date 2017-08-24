$( function(){
 
 //make the reg_number and id fields read only
 
   // document.getElementById('studentdetails-reg_no').readOnly = true;

     var reg_no = $('#studentattachmentdetails-reg_no').val();     	
     
     //pass the reg no to the get student details function to query results
     $.get('index.php?r=student-reg-details/get-student-details',{ reg_no : reg_no }, function(data){
     	var data = $.parseJSON(data);

     	//assign values from the db to the forms
     	/*$('#studentdetails-student_first_name').attr('value', data.first_name);
     	$('#studentdetails-student_middle_name').attr('value', data.middle_name);
     	$('#studentdetails-student_last_name').attr('value', data.last_name);
     	$('#studentdetails-course').attr('value', data.course);
     	$('#studentdetails-year_of_study').attr('value', data.year_of_study);
     	$('#studentdetails-faculty_id').attr('value', data.faculty_id);
     	$('#studentdetails-department_id').attr('value', data.department_id); */    	
     	
     } );
 
 

});