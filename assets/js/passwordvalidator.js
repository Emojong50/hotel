$(document).ready(function() {
    var passwordMatch = false;
    var passwordMeetsCriteria = false;
    
    $('#password').on('keyup', function() {
      var password = $(this).val();
      var passwordValidationMsg = $('#password_validation');
      var missing = [];
  
      // Check if password meets criteria
      if (password.length < 8) {
        missing.push('at least 8 characters');
      }
      if (!/\d/.test(password)) {
        missing.push('at least one number');
      }
      if (!/[a-z]/.test(password)) {
        missing.push('at least one lowercase letter');
      }
      if (!/[A-Z]/.test(password)) {
        missing.push('at least one uppercase letter');
      }
    //   if (!/[!@#$%^&*]/.test(password)) {
    //     missing.push('at least one special character (!@#$%^&*)');
    //   }
      
      if (missing.length > 0) {
        passwordValidationMsg.text('Password must contain ' + missing.join(', ') + '.');
        passwordValidationMsg.css('color', 'red');
        passwordMeetsCriteria = false;
      } else {
        passwordValidationMsg.text('');
        passwordMeetsCriteria = true;
      }
      
      passwordMatch = ($('#cpassword').val() === password);
      updateSignupButton();
    });
    
    // Check if passwords match on input of confirm password field
    $('#cpassword').on('input', function() {
      var password = $('#password').val();
      var confirmPassword = $(this).val();
      var passwordValidationMsg = $('#password_validation');
      
      if (password !== confirmPassword) {
        passwordValidationMsg.text('Passwords do not match!');
        passwordValidationMsg.css('color', 'red');
        passwordMatch = false;
      } else {
        passwordValidationMsg.text('');
        passwordMatch = true;
      }
      
      updateSignupButton();
    });
    
    function updateSignupButton() {
      if (passwordMatch && passwordMeetsCriteria) {
        $('#signup').prop('disabled', false);
        var passwordValidationMsg = $('#password_validation');
        passwordValidationMsg.text('password match');
        passwordValidationMsg.css('color', 'green');
      } else {
        $('#signup').prop('disabled', true);
      }
    }
  });
  