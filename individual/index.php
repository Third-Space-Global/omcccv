<?php
session_start();

if(isset($_SESSION['name']) && isset($_SESSION['id'])) {
    

$name = $_SESSION['name'];
$user_id = $_SESSION['id']; 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OMC Availability System</title>
    <link rel="icon" href="https://thirdspaceportal.com/system/inhouse-directory/tsp vertical logo-01.png"
        type="image/png" sizes="16x16">

    <!-- jQuery  -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.js"></script>

    <!-- DataTables -->
    <!--     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> -->

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        &nbsp;&nbsp;<a class="navbar-brand" href="../"><img style="height: 40px;" class="logo"
                src="https://thirdspaceportal.com/internal_system/wp-content/uploads/2021/01/black_TSP_logo-01-01.png"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="../">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="../availabilities">Availabilities</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="./">Individual</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../temporary_availabilities">Temporary Availabilities</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="wrapper">
            <div class="card-bg">
                <div class="input-group" id="DateDemo">
                    <div style="display: flex; align-items: center;">
                        <div>
                            <i class="bi bi-chevron-left" onclick="prev()"></i>
                        </div>
                        <input name="startDate" class="date-picker" disabled />
                        <div>
                            <i class="bi bi-chevron-right" onclick="next()"></i>
                        </div>
                    </div>

                    <div>
                        <button class="btn btn-secondary" id="btn-edit"
                            onclick="convertTableToForm('tab_trial')">Edit</button>
                        <button class="btn btn-secondary" id="btn-cancel">Cancel</button>
                        <button class="btn btn-primary" id="btn-submit" onclick="saveUpdates()">Save</button>
                    </div>
                </div>
                <table id="tab_trial">
                    <thead>
                        <tr>
                            <th>Slot</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                        </tr>
                    </thead>
                    <tbody>


                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <script src="js/individualAction.js"></script>
    <script src="js/date.js"></script>
    <script src="js/buttonActions.js"></script>
</body>

</html>

<?php 
} else {
    header("Location: ../login.php");
}
?>