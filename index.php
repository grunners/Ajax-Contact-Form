<html>
<head>
	

</head>

<body>

<p id="contact_results"></p>

<form id="contactform" data-toggle="validator" role="form" data-disable="false">
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
      <option value="1">I cannot afford to repay any of my loan on time</option>
      <option value="2">I can only make a partial payment towards my loan</option>
      <option value="3">I would like to apply for another loan with you</option>
      <option value="4">I would like to make a complaint</option>
      <option value="5">I would like to apply to cancel the Continuous Payment Authority</option>
      <option value="6">Other</option>
    </select>
    <div class="help-block with-errors"></div>
  </div>
	<div class="form-group">
		<label for="txtEnquiry">More details (optional)</label>
		<input id="txtEnquiry" name="txtEnquiry" type="text" class="form-control" />
		<div class="help-block with-errors"></div>
	</div>
	<button type="submit" class="btn btn-primary" name="btnSubmit" id="btnSubmit" >Submit</button>
</form>

<!-- include jquery -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="/js/validator.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
      $('#contactform').on('submit', function (e) {
        e.preventDefault();
        //var btn = $(this).attr('id');
        $.ajax({
            url: '/includes/mail.php',
            type: 'POST',
            data: { 
              param: $('#contactform').serialize()        
            },

            //valid json response
            success: function(data) {
              //alert(data);
              if (data.status == "success") {
                $('#contact_info').addClass('bg-success');
                $('#contact_info').html(data.message);
              }
              else {
                $('#contact_info').addClass('bg-danger');
                $('#contact_info').html(data.message);
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
