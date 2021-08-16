<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container-bg">
        <div class="background">
            <div class="card">
                <div>
                    <img class="logo"
                        src="https://thirdspaceportal.com/internal_system/wp-content/uploads/2021/05/Black_TSP_logo-01-01.png"
                        height="35">
                </div>
                <div>
                    <h1>New Password</h1>
                </div>
                <div class="inp-container">
                    <input type="hidden" name="email" id="email" value="<?php echo $_GET['dt'] ?>">
                    <input type="password" id="newPwd" placeholder="New Password">
                    <p id="error"></p>
                </div>
                <div class="inp-container">
                    <input type="password" id="cnfPwd" placeholder="Confirm Password">
                    <p id="error"></p>
                </div>
                <div>
                    <button class="btn-change" id="btn-change">
                        Change Password
                    </button>
                </div>
                <div>
                    <a href="../">Return to login</a>
                </div>
            </div>
        </div>
    </div>

    <script src="action.js"></script>
   <!--  <script>
        $("#btn-send").on('click', function() {
            $(this).hide();
            $("#btn-submit").show();
            $("#otp-span").css('height', '50px');
        })
    </script> -->
</body>

</html>