



















                               <script>
            function submitForm(){
                var sysSerial   = document.forms["form1"]["sysSerial"].value;
                var sysMachType = document.forms["form1"]["sysMachType"].value;
                
                if(sysSerial == null || sysSerial == ""){
                    document.getElementById('errMsg').innerHTML = "Error : You must enter a serial number<br><br>";
                    document.getElementById('message').style.visibility = "visible";
                    return false;
                }else{
                    if(!/^[a-zA-Z0-9-]+$/.test(sysSerial)){
                        document.getElementById('errMsg').innerHTML = "Error : Your serial number must contain only alphanumeric characters<br><br>";
                        document.getElementById('message').style.visibility = "visible";
                        return false;
                    }else if(sysSerial.length < 7 || sysSerial.length > 16){
                        document.getElementById('errMsg').innerHTML = "Error : Your serial number must contain at least 7 alphanumeric characters<br><br>";
                        document.getElementById('message').style.visibility = "visible";
                        return false;
                    }
                }
                
                if(sysMachType.length > 0){
                    if(!/^[a-zA-Z0-9]+$/.test(sysMachType)){
                        document.getElementById('errMsg').innerHTML = "Error : Your machine type number must contain only alphanumeric characters<br><br>";
                        document.getElementById('message').style.visibility = "visible";
                        return false;
                    }else if(sysMachType.length < 4 || sysMachType.length > 4){
                        document.getElementById('errMsg').innerHTML = "Error : Your machine type number must be 4 alphanumeric characters<br><br>";
                        document.getElementById('message').style.visibility = "visible";
                        return false;
                    }
                }

                sysSerial = sysSerial.replace(/\ /g,"");
                sysSerial = sysSerial.replace(/\-/g,"");
                document.forms["form1"]["sysSerial"].value = sysSerial;
                document.getElementById('message').style.visibility= "hidden";
                
                $('#submitButton').attr('disabled', 'disabled');
				$('#submitButton').attr('style', 'font-weight:bold;color:#ffffff;background:#d1d1d1 !important;border:0px;cursor:default;');
				document.getElementById('form1').submit();
		
                return true;
            }

            function searchKeyPress(e){
                var keynum
                if(window.event) // IE
                    keynum = e.keyCode;
                else if(e.which) // Netscape/Firefox/Opera
                    keynum = e.which;

                if (keynum == 13){
                    submitForm();
                    return false;
                }
                return true;
            }

            function displayErr(){
                var errMsg = "";
                if(errMsg.match(/multiple/i)){errMsg="Multiple results found. Kindly enter Machine Type & Serial to refine results.";}
                if(errMsg!=""){
                    document.getElementById('errMsg').innerHTML = errMsg;
                    document.getElementById('message').style.visibility="visible";
                }
            }
			
			$(document).ready(function(){
                    //Hide (Collapse) the toggle containers on load
                    $(".toggle_container").show();

                    //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
                    $("span.trigger").click(function(){
                            $(this).toggleClass("active").next().slideToggle("slow");
                            return false; //Prevent the browser jump to the link anchor
                    });
           });
        </script>






































































































































                                                                                                        <script>(function() {with (this[2]) {with (this[1]) {with (this[0]) {return function(event) {return submitForm();
};}}}})</script>








                                                                                                                                                                               <script>(function() {with (this[2]) {with (this[1]) {with (this[0]) {return function(event) {return searchKeyPress(event);
};}}}})</script>