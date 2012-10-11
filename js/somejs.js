
function ageCount() {
	
	var birthDay = document.getElementById("member_bdate");
    var birthDay1 = document.getElementById("member_bdate").value;
	var now = new Date()
	var pattern = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
	
	if(pattern.test(birthDay1)){
		
	var b_split = birthDay.value.split('/');
	
	 if(b_split.length==3){
	   var birthDate = new Date(b_split[2], b_split[1]*1-1, b_split
		[0]);
	   
	   var years = Math.floor((now.getTime() - birthDate.getTime()) / (365.25 * 24 * 60 * 60 * 1000));
	   
	  document.getElementById('getage').innerHTML = years;
	  document.getElementById('member_age').value = years;
	
		 }
	   
	 }else{
			alert("Invalid Date Format.");	
			
	 }

    }


