<!DOCTYPE html>
<html>

<head>
    <title>Third Space Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="card-view" style="background: white;">
        <div class="row">
            <div class="col" id="pattern">
                <img src="./assets/images/Login-01.jpg" class="img-fluid" alt="Responsive image">
            </div>
            <div class="col" id="login-form">
                <img src="./assets/images/login-page-Black_TSP_logo-01-01-01.png"></img>
                <form action="./action/login.php" method="post" id="login">
                    <div id="err-message">
                        <?php if (isset($_GET['error'])) { ?>
                        <p class="error">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                <path
                                    d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                            </svg>&nbsp;<?php echo $_GET['error']; ?>
                        </p>
                        <?php } ?>
                    </div>
                    <label>Username</label>
                    <input type="text" name="uname" placeholder="Email"><br>

                    <label>Password</label>
                    <input type="password" name="password" placeholder="*********"><br>

                    <button type="submit">Login</button>

                </form>
                <div class="reset_pwd">
                    <a href="./password_reset">Forgot Your Password.</a>
                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        function handleResize() {
            if ($(window).width() < 600) {
                $("#pattern").hide();
            } else {
                $("#pattern").show();
            }
        }

        handleResize();
        $(window).resize(function() {
            handleResize();
        });
    });
    </script>
</body>

</html>