

$(document).ready(function () {
  $("#save").on("click", function () {
    let mon = [],
      tue = [],
      wed = [],
      thu = [],
      fri = [],
      availabilities = [],
      eligibility = 1;


    $("#slot1")
      .find("select")
      .each(function (index) {
        let obj = new Object();

        obj.id = $(this).attr("id");
        obj.value = $(this).val();

        if (obj.id == "m1") {
          mon.push(obj);
        } else if (obj.id == "t1") {
          tue.push(obj);
        } else if (obj.id == "w1") {
          wed.push(obj);
        } else if (obj.id == "th1") {
          thu.push(obj);
        } else if (obj.id == "f1") {
          fri.push(obj);
        }
      });

    $("#slot2")
      .find("select")
      .each(function (index) {
        let obj = new Object();
        obj.id = $(this).attr("id");
        obj.value = $(this).val();

        if (obj.id == "m2") {
          mon.push(obj);
        } else if (obj.id == "t2") {
          tue.push(obj);
        } else if (obj.id == "w2") {
          wed.push(obj);
        } else if (obj.id == "th2") {
          thu.push(obj);
        } else if (obj.id == "f2") {
          fri.push(obj);
        }
      });

    $("#slot3")
      .find("select")
      .each(function (index) {
        let obj = new Object();
        obj.id = $(this).attr("id");
        obj.value = $(this).val();

        if (obj.id == "m3") {
          mon.push(obj);
        } else if (obj.id == "t3") {
          tue.push(obj);
        } else if (obj.id == "w3") {
          wed.push(obj);
        } else if (obj.id == "th3") {
          thu.push(obj);
        } else if (obj.id == "f3") {
          fri.push(obj);
        }
      });

    $("#slot4")
      .find("select")
      .each(function (index) {
        let obj = new Object();
        obj.id = $(this).attr("id");
        obj.value = $(this).val();

        if (obj.id == "m4") {
          mon.push(obj);
        } else if (obj.id == "t4") {
          tue.push(obj);
        } else if (obj.id == "w4") {
          wed.push(obj);
        } else if (obj.id == "th4") {
          thu.push(obj);
        } else if (obj.id == "f4") {
          fri.push(obj);
        }
      });


    $("#slot5")
      .find("select")
      .each(function (index) {
        let obj = new Object();
        obj.id = $(this).attr("id");
        obj.value = $(this).val();

        if (obj.id == "m5") {
          mon.push(obj);
        } else if (obj.id == "t5") {
          tue.push(obj);
        } else if (obj.id == "w5") {
          wed.push(obj);
        } else if (obj.id == "th5") {
          thu.push(obj);
        } else if (obj.id == "f5") {
          fri.push(obj);
        }
      });

    $("#slot6")
      .find("select")
      .each(function (index) {
        let obj = new Object();
        obj.id = $(this).attr("id");
        obj.value = $(this).val();

        if (obj.id == "m6") {
          mon.push(obj);
        } else if (obj.id == "t6") {
          tue.push(obj);
        } else if (obj.id == "w6") {
          wed.push(obj);
        } else if (obj.id == "th6") {
          thu.push(obj);
        } else if (obj.id == "f6") {
          fri.push(obj);
        }
      });

    $("#slot7")
      .find("select")
      .each(function (index) {
        let obj = new Object();
        obj.id = $(this).attr("id");
        obj.value = $(this).val();

        if (obj.id == "m7") {
          mon.push(obj);
        } else if (obj.id == "t7") {
          tue.push(obj);
        } else if (obj.id == "w7") {
          wed.push(obj);
        } else if (obj.id == "th7") {
          thu.push(obj);
        } else if (obj.id == "f7") {
          fri.push(obj);
        }
      });
    availabilities.push(mon);
    availabilities.push(tue);
    availabilities.push(wed);
    availabilities.push(thu);
    availabilities.push(fri);

    //check null
    $.each(availabilities, function (index, dayList) {
      $.each(dayList, function (index, slot) {
        if (slot.value == null) {
          eligibility = 0;
        }
      });
    });

    if (eligibility) {
      $.ajax({
        type: "POST",
        url: "action/omc_off.php",
        dataType: "json",
        data: {
          availabilities: JSON.stringify(availabilities),
        },
        success: function (data) {
          // alert(data);
        },
        error: function (data) {
          // alert(data);

          // Swal.fire({
          //   'title': 'Errors',
          //   'text': 'There were errors while saving the .',
          //   'type': 'error'
          // })
        }
      });
    }

  });
});
