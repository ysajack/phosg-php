$(document).ready(function(){
    $("#checkout").click(function(){
        $("#form").slideDown("slow");
        $("#checkout").hide();
    });

    $("#close").click(function(){
        $(".orderinfo").hide();

    });

    $("#btnstat").click(function(){
        $(".stat").slideDown("slow");
        $("#enternum").show();
    });
    
    $("#closestat").click(function(){
        $(".stat").hide();
        $("#enternum").hide();
    });
    
    $("#btnlookup").click(function(){
        $("#orderlist").hide();
        $("#searchdetails").show();
    });


});



function validateQty(){
 var inputObj=document.getElementById("inputqty");
 if (inputObj.checkValidity()==false){
     document.getElementById("validateqty").innerHTML=inputObj.validityMessage;
}
}




function lookDetails(str) {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("statdetails").innerHTML = xhttp.responseText;
 
    }
  }
  xhttp.open("GET", "orderdetails.php?ordernum="+str, true);
  xhttp.send();
}


		


		