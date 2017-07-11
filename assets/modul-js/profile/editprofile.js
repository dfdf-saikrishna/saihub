var Script = function () {

    $.validator.setDefaults({
        submitHandler: function() { 
            var fname=$("#fname").val();
            var lname=$("#lname").val();
            var gender=$("#gender").val();
            var email=$("#cemail").val();
            var mobile=$("#mobile").val();
            var phone=$("#phone").val();
            var address=$("#address").val();
            var city=$("#city").val();
            var state=$("#state").val();
            var country=$("#country").val();
            var zip=$("#zip").val();
            var dataString = 'fname='+fname+'&lname='+lname+'&email='+email+'&gender='+gender+'&mobile='+mobile+'&phone='+phone+'&address='+address+'&city='+city+'&state='+state+'&country='+country+'&zip='+zip;
           
             $.ajax({
                type: "POST",
                url: "/profile/edit/update",
                data: dataString,
                cache: false,
                beforeSend: function(){ 
                    $("#submitprofile").hide();
                    $("#waiting").show();
                    $("#suksesupdate").hide();
                    $("#gagalupdate").hide();
                },
                complete: function(e, xhr, settings){
                    if(e.status === 200){
                        $("#submitprofile").show();
                        $("#waiting").hide();
                        $("#suksesupdate").show();
                        //$("#gagalupdate").hide();
                    }else{
                        $("#submitprofile").show();
                        $("#waiting").hide();
                        //$("#suksesupdate").show();
                        $("#gagalupdate").show();
                    }
                }
                
            });
        
        return false;
        }
    });

    $().ready(function() {
        // validate the comment form when it is submitted
        $("#editForm").validate();
    });
	
	// Hide or show Payment Details in Upgrade
	$('body').on('click', '.upgrade', function() {
	var amount = $(this).attr("amount");
	var product = $(this).attr("product");
	$("#submit-upgrade").attr("amount", amount);
	$("#submit-upgrade").attr("product", product);
	if(amount>=1000){
		$('#payment-div').show();
	}
	else{
		$('#payment-div').hide();
	}

	});
	
	// Upgrade Action
	$('body').on('click', '#submit-upgrade', function() {
	var pin = $('#pinverify').val();
	var amount = $(this).attr("amount");
	var product = $(this).attr("product");
	var dataString = 'pin=' + pin + '&amount=' + amount + '&product=' + product;
	$.ajax({
                type: "POST",
                url: "/profile/upgrade",
                data: dataString,
                cache: false,
                beforeSend: function () {
                    $("#status").html('<p>Connecting to server....</p>');
                },
                complete: function (e, xhr, settings) {
					console.log(e);
                    if (e.status === 200) {
						$('#successupgrade').show();
                        //$("#status").html("<span style='color: #00CC96;'>Success:</span> Redirecting to dashboard ");
                        // TRIGGER SETELAH SUKSES NANTI DISINI, BISA BERUPA DIRECT KE DASHBOARD
                        setTimeout(function () {
                            //window.location.href = "/dashboard"; // The URL that will be redirected too.
							$('#upgrade').modal('hide');
							location.reload();
                        }, 3000);
                    } else {
                        //Shake animation effect.
						$('#failureupgrade').show();
					    setTimeout(function () {
							//window.location.href = "/dashboard"; // The URL that will be redirected too.
							$('#failureupgrade').fadeOut();
						}, 3000);
                    }
                }

            });

	});


}();