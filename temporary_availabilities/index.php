<?php
include('action/database_connection.php');
session_start();

if (isset($_SESSION['name']) && isset($_SESSION['id'])) {


    $name = $_SESSION['name'];
    $user_id = $_SESSION['id'];

    $squery = "SELECT DISTINCT supervisor_id, supervisor FROM ls_directory ORDER BY supervisor";
    $stmt = $connect->prepare($squery);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $supArr = array();

    $supervisors = "";

    foreach ($result as $row) {
        $sub_array = array();
        $sub_array[] = $row['supervisor_id'];
        $sub_array[] = $row['supervisor'];

        $supArr[] = $sub_array;
    }

    foreach ($supArr as $item) {
        $supervisors .= '<option value="' . $item[0] . '">' . $item[1] . '</option>';
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OMC Availability System</title>
        <link rel="icon" href="https://thirdspaceportal.com/system/inhouse-directory/tsp vertical logo-01.png" type="image/png" sizes="16x16">

        <!-- jQuery  -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <!-- DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous">
        </script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            &nbsp;&nbsp;<a class="navbar-brand" href="../"><img style="height: 40px;" class="logo" src="https://thirdspaceportal.com/internal_system/wp-content/uploads/2021/01/black_TSP_logo-01-01.png"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
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
                        <a class="nav-link" href="../individual">Individual</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./">Temporary Availabilities</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="card-bg">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-3" style="display: flex;">
                                <label for="supervisor">Supervisor: </label>
                                <select name="supervisor" id="supervisor" class="form-control"><?php echo $supervisors ?></select>
                            </div>
                            <div class="col-md-3" style="display: flex;">
                                <label for="name">Name: </label>
                                <select name="name" id="name" class="form-control"></select>
                            </div>
                            <div class="col-md-1">
                                <button id="clear-filters" class="clear-filters">Clear Filters</button>
                            </div>
                            <div class="col-md-1">
                                <div class="dropdown">
                                    <button class="bulk dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                        Bulk Action
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="dp_menu">

                                    </ul>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table id="tab_temp_availability" class="table responsive wrap">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                            <th colspan="7">
                                                <div class="day-filter">
                                                    <div>
                                                        <i class="bi bi-chevron-left" id="prev"></i>
                                                    </div>
                                                    <div>
                                                        <select class="form-control" name="day" id="day">
                                                            <option value="monday">Monday</option>
                                                            <option value="tuesday">Tuesday</option>
                                                            <option value="wednesday">Wednesday</option>
                                                            <option value="thursday">Thursday</option>
                                                            <option value="friday">Friday</option>
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <i class="bi bi-chevron-right" id="next"></i>
                                                    </div>
                                                </div>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th>Supervisor</th>
                                            <th>Tutor</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Slot 1</th>
                                            <th>Slot 2</th>
                                            <th>Slot 3</th>
                                            <th>Slot 4</th>
                                            <th>Slot 5</th>
                                            <th>Slot 6</th>
                                            <th>Slot 7</th>
                                            <th></th>
                                            <th><input type="checkbox" name="select-all" id="checkAll"></th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel"></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <table id="tab_fullAvailabilites">
                                    <thead>
                                        <tr>
                                            <th>Day</th>
                                            <th>Slot 1</th>
                                            <th>Slot 2</th>
                                            <th>Slot 3</th>
                                            <th>Slot 4</th>
                                            <th>Slot 5</th>
                                            <th>Slot 6</th>
                                            <th>Slot 7</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <div>
                                    <button class="btn btn-secondary" id="btn-edit" onclick="convertTableToForm('tab_fullAvailabilites')">Edit</button>
                                    <button class="btn btn-primary" id="btn-submit" onclick="saveUpdates()">Save</button>
                                </div>
                                <div>
                                    <button type="button" class="btn btn-success">Approve</button>
                                    <button type="button" class="btn btn-danger">Reject</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script>
                var supervisors = '<?php echo $supervisors ?>';
            </script>
            <script src="js/tabAvailability.js"></script>
            <script src="js/buttonActions.js"></script>
    </body>

    </html>
    <!-- <script>
        $('#vehicleChkBox').change(function() {

            if ($(this).attr('checked')) {
                $(this).val('TRUE');
            } else {
                $(this).val('FALSE');
            }

            alert($(this).val());

        });
    </script> -->

<?php
} else {
    header("Location: ../login.php");
}
?>