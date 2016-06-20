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
    <label for="txtEmail">Email Address</label>
    <input id="txtEmail" name="txtEmail" type="email" pattern="[^ @]*@[^ @]*" class="form-control" placeholder="Your email address" data-error="Please provide a valid email address" required />
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
    	$('#form').validator().on('submit', function (e) {
        
        if (!e.isDefaultPrevented()) {

          //disable default behaviour first
          e.preventDefault();
          //then post
          post_data = {
              'txtName' : $('input[name=txtName]').val(),
              'txtEmail' : $('input[name=txtEmail]').val(),
              'txtEnquiry' : $('input[name=txtEnquiry]').val()
          };
         
          //Ajax post data to server
          $.post('/includes/mail.php', post_data, function(response){  
              if(response.type == 'error'){ //load json data from server and output message    
                  output = '<div class="alert alert-danger">' + response.text + '</div>';
              }else{
                  output = '<div class="alert alert-success">' + response.text + '</div>';
                  //disable the submit button
                  $('#btnSubmit').attr('disabled','disabled');
              }
              $("#form #contact-results").hide().html(output).fadeIn();
          }, 'json');
        }
      });
    });
</script>
	
</body>

</html>
