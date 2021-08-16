$(document).ready(function () {
  $("#btn-change").on("click", function () {
    $.ajax({
      type: "POST",
      url: "../action/changePassword.php",
      dataType: "json",
      data: {
        email: $("#email").val(),
        password: $("#newPwd").val(),
      },
      success: function (data) {
        if (data.result === "Success") {
          window.location.href = "http://localhost/login_system/";
        } else if (data.result === "Failed") {
          alert("Failed");
        }
      },
    });
  });

  $("#newPwd", "#cnfPwd").on("keyup", function () {
    console.log(confirmEmail($("#newPwd").val(), $("#cnfPwd").val()));
  });
});

function confirmEmail(pwd, confpwd) {
  if (pwd != confpwd) {
    return false;
  } else {
    return true;
  }
}
