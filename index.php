<html>
<head>
	

</head>

<body>

<!--html form - default is using bootstrap client-side validation-->
<form id="form" data-toggle="validator" role="form" data-disable="false">
	<h3>Get In Touch</h3>
	<p class="centerText">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	<div class="form-group">
		<label for="txtName">Name</label>
		<input id="txtName" name="txtName" type="text" class="form-control" placeholder="Your name" data-error="Please provide your name" required />
		<div class="help-block with-errors"></div>
	</div>
  <div class="form-group">
    <label for="txtEmail">Email</label>
    <input id="txtEmail" name="txtEmail" type="text" class="form-control" placeholder="Your number" data-error="Please provide an email address" required />
    <div class="help-block with-errors"></div>
  </div>
	<div class="form-group">
		<label for="txtTel">Telephone</label>
		<input id="txtTel" name="txtTel" type="text" class="form-control" placeholder="Your number" data-error="Please provide a telephone number" required />
		<div class="help-block with-errors"></div>
	</div>
	<div class="form-group">
		<label for="txtEnquiry">Enquiry</label>
		<input id="txtEnquiry" name="txtEnquiry" type="text" class="form-control" placeholder="Your message" data-error="Please provide a message" required />
		<div class="help-block with-errors"></div>
	</div>
	<button type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit" >Submit</button>
	<div id="contact-results"></div>
</form>

<!-- include jquery -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="/js/validator.js"></script>
<script type="text/javascript">
// serialize this bit
    $(document).ready(function() {
      $('#form').on('submit', function (e) {
        e.preventDefault();
        //var btn = $(this).attr('id');
        $.ajax({
            url: '/includes/mail.php',
            type: 'POST',
            data: { 
              param: $('#form').serialize()        
            },
            //dataType: 'json', //not needed if header type is given in php

            //valid json response
            success: function(data) {
              //alert(data);
              if (data.status == "success") {
                alert(data.message);
              }
              else {
                alert(data.message);
              }
            },
            //invalid json response
            error: function(data) {
              alert("error - http code: " + data.status);
            }
        });
      });
    });
</script>
	
</body>

</html>
