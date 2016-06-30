<html>
<head>
	

</head>

<body>

<form id="form" data-toggle="validator" role="form" data-disable="false">
	<h3>Get In Touch</h3>
	<p class="centerText">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
	<div class="form-group">
		<label for="txtName">Your full name</label>
		<input id="txtName" name="txtName" type="text" class="form-control" data-error="Please provide your name" required />
		<div class="help-block with-errors"></div>
	</div>
  <div class="form-group">
    <label for="txtEmail">Your email address</label>
    <input id="txtEmail" name="txtEmail" type="email" class="form-control" data-error="Please provide an email address" required />
    <div class="help-block with-errors"></div>
  </div>
	<div class="form-group">
		<label for="txtTel">Your telephone number</label>
		<input id="txtTel" name="txtTel" type="text" class="form-control" data-error="Please provide a telephone number" required />
		<div class="help-block with-errors"></div>
	</div>
  <div class="form-group">
    <label for="txtAccount">Your reference number (if applicable)</label>
    <input id="txtAccount" name="txtAccount" type="text" class="form-control" data-error="Please provide a telephone number" required />
    <div class="help-block with-errors"></div>
  </div>
  <div class="form-group">
    <label for="listCategory">Please select what your enquiry is about from the following list. This will ensure your enquiry is dealt with by the correct department.</label>
    <select id="listCategory" class="listCategory" name="listCategory">
      <option selected="selected" value="info#No category selected#0">Select a category...</option>
      <option value="message1">message1</option>
      <option value="message2">message2</option>
    </select>
    <div class="help-block with-errors"></div>
  </div>
	<div class="form-group">
		<label for="txtEnquiry">More details (optional)</label>
		<input id="txtEnquiry" name="txtEnquiry" type="text" class="form-control" />
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
