$(document).ready(function () {
  $("#btn-submit").hide();

  $("#btn-send").on("click", function () {
    if ($("#email").val() === "") {
      $("#error").html(`Email cannot be empty.`);
    } else if (validateEmail($("#email").val())) {
      $("#error").html(``);
      $.ajax({
        type: "POST",
        url: "../action/resetPassword.php",
        dataType: "json",
        data: {
          email: $("#email").val(),
        },
        success: function () {
          $("#email").parent().hide();
          $("#btn-send").hide();

          $("#btn-submit").show();
          $("#otp-span").css("height", "50px");
        },
      });
    } else {
      $("#error").html("Email is invalid.");
    }
  });

  $("#btn-submit").on("click", function () {
    if ($("#otp-no").val() === ""){
      $("#otp-error").html(`OTP cannot be empty.`);
    } else {
      $("#otp-error").html(``);
      $.ajax({
        type: "POST",
        url: "../action/confirmOTP.php",
        dataType: "json",
        data: {
          otp: $("#otp-no").val(),
        },
        success: function (data) {
          window.location.href = `http://localhost/login_system/new_password?dt=${data.email}`;
        },
      });
    }
      
  });
});

function validateEmail(email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  if (emailReg.test(email)) {
    return true;
  } else {
    return false;
  }
}
