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
                    <h1>Reset Password</h1>
                </div>
                <div class="inp-container">
                    <input type="email" name="email" id="email" placeholder="Email">
                    <p id="error"></p>
                </div>
                <div id="otp-span" class="inp-container">
                    <input type="number" name="otp-no" id="otp-no">
                    <p id="otp-error"></p>
                </div>
                <div>
                    <button class="btn-otp" id="btn-send">
                        Send OTP Code
                    </button>
                </div>
                <div>
                    <button class="btn-otp" id="btn-submit">
                        Submit OTP
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