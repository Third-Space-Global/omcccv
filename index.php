<?php
require_once('config.php');
session_start();

if(isset($_SESSION['name']) && isset($_SESSION['id'])) {

$name = $_SESSION['name'];
$user_id = $_SESSION['id']; 


// $_SESSION['user_name'] = $row['user_name'];
// $_SESSION['name'] = $row['name'];
// $_SESSION['id'] = $row['id'];

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>OMC Availability System</title>
    <link rel="icon" href="https://thirdspaceportal.com/system/inhouse-directory/tsp vertical logo-01.png" type="image/png" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"> -->

    <style>
        *,
        *:before,
        *:after {
            box-sizing: border-box;
        }

        .top-bottom-buffer {
            margin-top: 20px;
            margin-bottom: 20px;
            /* height: 90px; */
        }

        .availability_day_slot_title {
            color: #398cda;
        }

        .btn_shadow {
            box-shadow: 3px 3px 8px #a5a5a5;
        }

        #save:hover {
            color: #c4e6ec;
            background-color: #398CFD;
        }

        #save {
            font-family: Nunito, sans-serif;
            background-color: #398cda;
            color: #ffff;
            width: 110px;
            height: 32px;
            font-size: 13px;
            margin: 5px;
        }

        #change:hover {
            color: #c4e6ec;
            background-color: #398CFD;
        }

        #change {
            font-family: Nunito, sans-serif;
            background-color: #398cda;
            color: #ffff;
            width: 150px;
            height: 32px;
            font-size: 13px;
            margin: 5px;
        }

        #submit_profile:hover {
            color: #c4e6ec;
            background-color: #38cca1;
        }

        #submit_profile {
            font-family: Nunito, sans-serif;
            background-color: #0cb597;
            color: #ffff;
            /* width: 110px; */
            height: 32px;
            font-size: 13px;
            margin: 5px;
        }

        .card-bg {
            margin: 15px auto 15px auto;
            width: 100%;
            background: #fafbff;
            box-shadow: 0px 0px 16px 8px rgb(199 198 198 / 25%), -8px -8px 20px #ffffff;
            border-radius: 12px;
            padding: 30px;
        }

        .day-title {
            font-family: Nunito, sans-serif;
            border: none !important;
            vertical-align: middle;
            font-size: 17px;
            font-weight: 600;
            color: #398cda;
            text-align: center;
            text-shadow: none;
        }

        .slot-title {
            font-family: Nunito, sans-serif;
            border: none !important;
            vertical-align: middle;
            font-size: 17px;
            font-weight: 600;
            /* color: #398cda; */
            text-align: center;
            text-shadow: none;
        }

        .input-select {
            font-family: Nunito, sans-serif;
            vertical-align: middle;
            font-size: 14px;
            font-weight: 600;
            text-align: center;
            text-align-last: center;
            text-shadow: none;
            width: 100%;
            max-width: 150px;
            min-width: 75px;
            border: 2px solid #d7d9d9;
            border-radius: 5px;
            height: 28px;
        }

        .input-select :focus {
            outline: 2px solid #d7d9d9;
        }

        .div-spaces {
            margin-top: 30px;
        }

        .div-col-padding {
            padding-left: 27px;
            padding-right: 27px;
            text-align-last: center;
        }

        .div-save-btn {
            text-align: right;
        }

        .div-change-btn {
            text-align: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        &nbsp;&nbsp;<a class="navbar-brand" href="./"><img style="height: 40px;" class="logo" src="https://thirdspaceportal.com/internal_system/wp-content/uploads/2021/01/black_TSP_logo-01-01.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="./">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./availabilities">Availabilities</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./individual">Individual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./temporary_availabilities/">Temporary Availabilities</a>
                </li>
            </ul>
        </div>
    </nav>

    <!--  Availability system form ------------------------------------------------------------------------------------->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- <div class="card-bg"> -->
                <form id="availability_form">
                    <div class="row top-bottom-buffer">
                        <div class="col-sm-3 div-change-btn">
                            <input type="button" class="btn btn_shadow" id="change" name="change" value="Change Availability">
                        </div>
                        <div class="col-sm-5">
                        </div>
                        <div class="col-sm-4 div-save-btn">
                            <input type="Submit" class="btn btn_shadow" id="save" name="save" value="Submit">
                            <input type="button" class="btn btn_shadow" id="submit_profile" name="submit_profile" value="Submit Profile for Review">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row ">
                                <div class="col-sm-2">
                                    <h5 class="day-title">Slots</h5>
                                </div>
                                <div class="col-sm-2">
                                    <h5 class="day-title">Monday</h5>
                                </div>
                                <div class="col-sm-2">
                                    <h5 class="day-title">Tuesday</h5>
                                </div>
                                <div class="col-sm-2">
                                    <h5 class="day-title">Wednesday</h5>
                                </div>
                                <div class="col-sm-2">
                                    <h5 class="day-title">Thursday</h5>
                                </div>
                                <div class="col-sm-2">
                                    <h5 class="day-title">Friday</h5>
                                </div>
                            </div>

                            <div class="row div-spaces" id="slot1">
                                <div class="col-sm-2">
                                    <h5 class="slot-title">Slot 1</h5>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="m1" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="t1" id="t1" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="w1" id="w1" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="th1" id="th1" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="f1" id="f1" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row div-spaces" id="slot2">
                                <div class="col-sm-2">
                                    <h5 class="slot-title">Slot 2</h5>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="m2" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="t2" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="w2" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="th2" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="f2" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row div-spaces" id="slot3">
                                <div class="col-sm-2">
                                    <h5 class="slot-title">Slot 3</h5>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="m3" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="t3" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="w3" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="th3" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="f3" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row div-spaces" id="slot4">
                                <div class="col-sm-2">
                                    <h5 class="slot-title">Slot 4</h5>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="m4" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="t4" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="w4" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="th4" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="f4" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row div-spaces" id="slot5">
                                <div class="col-sm-2">
                                    <h5 class="slot-title">Slot 5</h5>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m5" id="m5" class="input-select" required>
                                        <option value=""> </option>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="t5" id="t5" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="w5" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="th5" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="f5" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row div-spaces" id="slot6">
                                <div class="col-sm-2">
                                    <h5 class="slot-title">Slot 6</h5>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="m6" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m1" id="t6" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="w6" id="w6" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="th6" id="th6" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="f6" id="f6" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row div-spaces" id="slot7">
                                <div class="col-sm-2">
                                    <h5 class="slot-title">Slot 7</h5>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="m7" id="m7" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="t7" id="t7" class="input-select" required>
                                        <option disabled selected value> </option>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="w7" id="w7" class="input-select" required>
                                        <option disabled selected value> </option>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="th7" id="th7" class="input-select" required>
                                        <option disabled selected value> </option>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                                <div class="col-sm-2 div-col-padding">
                                    <select name="f7" id="f7" class="input-select" required>
                                        <option disabled selected value>
                                        <option value=1>Yes</option>
                                        <option value=0>No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <!-- </div> -->
            </div>
        </div>
    </div>
    <script src="availability/action.js"></script>

    <script>
        //get Availability
        getAvailability();

        function getAvailability() {
            $.ajax({
                url: './action/getAvailability.php',
                method: "POST",
                async: false,
                cache: false,
                data: {},
                success: function(data) {

                    if (data != "null") {
                        var obj = JSON.parse(data);
                        $.each(obj, function(key, value) {
                            (value === "1") ? $('#' + key).val(1): $('#' + key).val(0);
                            $('#' + key).attr("disabled", true);
                        });

                        $('#save').attr("disabled", true);
                    }
                }

            });
        };

        $(document).ready(function() {
            $("#change").on("click", function() {
                $('#save').attr("disabled", false);
                $('#change').attr("disabled", true);
                $.each(['m', 't', 'w', 'th', 'f'], function(key, value) {
                    for (let i = 1; i < 8; i++) {
                        $('#' + value + i).attr("disabled", false);
                    }
                });

            });
        });
    </script>

</body>

</html>

<?php 
} else {
    header("Location: ./login.php");
}
?>