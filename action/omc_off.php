<?php
require_once('../config.php');
$connect = mysqli_connect("remotemysql.com", "TK1e63o82L", "sAJ9k6SVba", "TK1e63o82L");
session_start();
$name = $_SESSION['name'];
$user_id = $_SESSION['id']; 

if (isset($_POST['availabilities'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $availabilities = json_decode($_POST['availabilities'], true);

    $mon = $availabilities[0];
    $tue = $availabilities[1];
    $wed = $availabilities[2];
    $thu = $availabilities[3];
    $fri = $availabilities[4];

    //get supervisor
    $sql_ls = "SELECT supervisor,supervisor_id FROM `ls_directory` WHERE hr_tsp_id='$user_id'";
    $result_select = mysqli_query($connect, $sql_ls);
    $data_row = mysqli_fetch_array($result_select);
    $supervisor_name = $data_row['supervisor'];
    $supervisor_id = $data_row['supervisor_id'];

    //check permenant_availability exist
    $sql_permenant_select = "SELECT * FROM `permenant_availability` WHERE user_id='$user_id'";
    $result_permenant_select = mysqli_query($connect, $sql_permenant_select);
    $p_s = mysqli_fetch_array($result_permenant_select);

    if (mysqli_num_rows($result_permenant_select) > 0) {

        $sql_one = "SELECT * FROM `change_availability` WHERE user_id='$user_id'";
        $result_select = mysqli_query($connect, $sql_one);

        //check change_availability exist, IF exist update ELSE insert
        if (mysqli_num_rows($result_select) > 0) {
            $sql_two = "UPDATE change_availability SET 
            m1=?, m2=?, m3=?, m4=?, m5=?, m6=?, m7=?,
            t1=?, t2=?, t3=?, t4=?, t5=?, t6=?, t7=?,
            w1=?, w2=?, w3=?, w4=?, w5=?, w6=?, w7=?,
            th1=?, th2=?, th3=?, th4=?, th5=?, th6=?, th7=?,
            f1=?, f2=?, f3=?, f4=?, f5=?, f6=?, f7=?
            WHERE user_id=?";
            $stmt = $conn->prepare($sql_two);
            $result_two = $stmt->execute([
                $p_s['m1'], $p_s['m2'], $p_s['m3'], $p_s['m4'], $p_s['m5'], $p_s['m6'], $p_s['m7'],
                $p_s['t1'], $p_s['t2'], $p_s['t3'], $p_s['t4'], $p_s['t5'], $p_s['t6'], $p_s['t7'],
                $p_s['w1'], $p_s['w2'], $p_s['w3'], $p_s['w4'], $p_s['w5'], $p_s['w6'], $p_s['w7'],
                $p_s['th1'], $p_s['th2'], $p_s['th3'], $p_s['th4'], $p_s['th5'], $p_s['th6'], $p_s['th7'],
                $p_s['f1'], $p_s['f2'], $p_s['f3'], $p_s['f4'], $p_s['f5'], $p_s['f6'], $p_s['f7'],
                $user_id
            ]);
        } else {
            $sql_two = "INSERT INTO change_availability (
                user_id,name,supervisor_name,supervisor_id,
                m1, m2, m3, m4, m5, m6, m7,
                t1, t2, t3, t4, t5, t6, t7,
                w1, w2, w3, w4, w5, w6, w7,
                th1, th2, th3, th4, th5, th6, th7,
                f1, f2, f3, f4, f5, f6, f7) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
            $stmtinsert_one = $conn->prepare($sql_two);
            $result_two = $stmtinsert_one->execute([
                $user_id, $name, $supervisor_name, $supervisor_id,
                $p_s['m1'], $p_s['m2'], $p_s['m3'], $p_s['m4'], $p_s['m5'], $p_s['m6'], $p_s['m7'],
                $p_s['t1'], $p_s['t2'], $p_s['t3'], $p_s['t4'], $p_s['t5'], $p_s['t6'], $p_s['t7'],
                $p_s['w1'], $p_s['w2'], $p_s['w3'], $p_s['w4'], $p_s['w5'], $p_s['w6'], $p_s['w7'],
                $p_s['th1'], $p_s['th2'], $p_s['th3'], $p_s['th4'], $p_s['th5'], $p_s['th6'], $p_s['th7'],
                $p_s['f1'], $p_s['f2'], $p_s['f3'], $p_s['f4'], $p_s['f5'], $p_s['f6'], $p_s['f7']
            ]);
        }

        //update permenant_availability table
        $sql_three = "UPDATE permenant_availability SET action=?,
        m1=?, m2=?, m3=?, m4=?, m5=?, m6=?, m7=?,
        t1=?, t2=?, t3=?, t4=?, t5=?, t6=?, t7=?,
        w1=?, w2=?, w3=?, w4=?, w5=?, w6=?, w7=?,
        th1=?, th2=?, th3=?, th4=?, th5=?, th6=?, th7=?,
        f1=?, f2=?, f3=?, f4=?, f5=?, f6=?, f7=?
        WHERE user_id=?";
        $stmt = $conn->prepare($sql_three);
        $result_three = $stmt->execute([ 0,
            $mon[0]['value'], $mon[1]['value'], $mon[2]['value'], $mon[3]['value'], $mon[4]['value'], $mon[5]['value'], $mon[6]['value'],
            $tue[0]['value'], $tue[1]['value'], $tue[2]['value'], $tue[3]['value'], $tue[4]['value'], $tue[5]['value'], $tue[6]['value'],
            $wed[0]['value'], $wed[1]['value'], $wed[2]['value'], $wed[3]['value'], $wed[4]['value'], $wed[5]['value'], $wed[6]['value'],
            $thu[0]['value'], $thu[1]['value'], $thu[2]['value'], $thu[3]['value'], $thu[4]['value'], $thu[5]['value'], $thu[6]['value'],
            $fri[0]['value'], $fri[1]['value'], $fri[2]['value'], $fri[3]['value'], $fri[4]['value'], $fri[5]['value'], $fri[6]['value'],
            $user_id
        ]);

        if ($result_two && $result_three) {
            echo 1;
        } else {
            echo 0;
        }
    } else {
        //Insert permenant_availability table
        $query = "INSERT INTO permenant_availability (
        user_id,action,name,supervisor_name,supervisor_id,
        m1, m2, m3, m4, m5, m6, m7,
        t1, t2, t3, t4, t5, t6, t7,
        w1, w2, w3, w4, w5, w6, w7,
        th1, th2, th3, th4, th5, th6, th7,
        f1, f2, f3, f4, f5, f6, f7) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmtinsert_one = $conn->prepare($query);
        $result_one = $stmtinsert_one->execute([
            $user_id, 0, $name, $supervisor_name, $supervisor_id,
            $mon[0]['value'], $mon[1]['value'], $mon[2]['value'], $mon[3]['value'], $mon[4]['value'], $mon[5]['value'], $mon[6]['value'],
            $tue[0]['value'], $tue[1]['value'], $tue[2]['value'], $tue[3]['value'], $tue[4]['value'], $tue[5]['value'], $tue[6]['value'],
            $wed[0]['value'], $wed[1]['value'], $wed[2]['value'], $wed[3]['value'], $wed[4]['value'], $wed[5]['value'], $wed[6]['value'],
            $thu[0]['value'], $thu[1]['value'], $thu[2]['value'], $thu[3]['value'], $thu[4]['value'], $thu[5]['value'], $thu[6]['value'],
            $fri[0]['value'], $fri[1]['value'], $fri[2]['value'], $fri[3]['value'], $fri[4]['value'], $fri[5]['value'], $fri[6]['value']
        ]);

        if ($result_one) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
