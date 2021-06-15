
function edit_row(Driver_ID)
{
 var name=document.getElementById("Driver_Name"+Driver_ID);
 var age=document.getElementById("Driver_Age"+Driver_ID);
 var address=document.getElementById("Driver_Address"+Driver_ID);
 var state=document.getElementById("Driver_State"+Driver_ID);
 var city=document.getElementById("Driver_City"+Driver_ID);
 var postcode=document.getElementById("Driver_Postcode"+Driver_ID);
 var ic=document.getElementById("Driver_IC"+Driver_ID);
 var email=document.getElementById("Driver_Email"+Driver_ID);
 var mobile=document.getElementById("Driver_Mobile"+Driver_ID);


 document.getElementById("Driver_Name"+Driver_ID)="<input type='text' Driver_ID='name_text"+Driver_ID+"' value='"+name+"'>";
 document.getElementById("Driver_Age"+Driver_ID)="<input type='text' Driver_ID='age_text"+Driver_ID+"' value='"+age+"'>";
 document.getElementById("Driver_Address"+Driver_ID)="<input type='text' Driver_ID='address_text"+Driver_ID+"' value='"+address+"'>";
 document.getElementById("Driver_State"+Driver_ID)="<input type='text' Driver_ID='state_text"+Driver_ID+"' value='"+state+"'>";
 document.getElementById("Driver_City"+Driver_ID)="<input type='text' Driver_ID='city_text"+Driver_ID+"' value='"+city+"'>";
 document.getElementById("Driver_Postcode"+Driver_ID)="<input type='text' Driver_ID='postcode_text"+Driver_ID+"' value='"+postcode+"'>";
 document.getElementById("Driver_IC"+Driver_ID)="<input type='text' Driver_ID='ic_text"+Driver_ID+"' value='"+ic+"'>";
 document.getElementById("Driver_Email"+Driver_ID)="<input type='email' Driver_ID='email_text"+Driver_ID+"' value='"+email+"'>";
 document.getElementById("Driver_Mobile"+Driver_ID)="<input type='text' Driver_ID='mobile_text"+Driver_ID+"' value='"+mobile+"'>";
    
 document.getElementById("edit_button"+Driver_ID).style.display="none";
 document.getElementById("save_button"+Driver_ID).style.display="block";
}

function save_row(Driver_ID)
{
 var name=document.getElementById("name_text"+Driver_ID);
 var age=document.getElementById("age_text"+Driver_ID);
 var address=document.getElementById("address_text"+Driver_ID);
 var state=document.getElementById("state_text"+Driver_ID);
 var city=document.getElementById("city_text"+Driver_ID);
 var postcode=document.getElementById("postcode_text"+Driver_ID);
 var ic=document.getElementById("ic_text"+Driver_ID);
 var email=document.getElementById("email_text"+Driver_ID);
 var mobile=document.getElementById("mobile_text"+Driver_ID);
    
 $.ajax
 ({
  type:'post',
  url:'modify_records.php',
  data:{
   edit_row:'edit_row',
   row_id:Driver_ID,
   Driver_Name:name,
   Driver_Age:age,
   Driver_Address:address,
   Driver_State:state,
   Driver_City:city,
   Driver_Postcode:postcode,
   Driver_IC:ic,
   Driver_Email:email,
   Driver_Mobile:mobile
  },
  success:function(response) {
   if(response=="success")
   {
    document.getElementById("edit_button"+id).style.display="block";
    document.getElementById("save_button"+id).style.display="none";
   }
  }
 });
}
