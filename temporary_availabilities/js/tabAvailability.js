$(function () {
  fillDataTable();

  function fillDataTable() {
    var dataTable = $("#tab_temp_availability").DataTable({
      dom: "<tp>",
      serverSide: true,
      searching: true,
      destroy: true,
      bSort: false,
      ajax: {
        type: "GET",
        url: "action/fetch_availability.php",
        data: function (d) {
          d.name = $("#name").val();
          d.day = $("#day").val();
        },
      },
      columnDefs: [
        {
          targets: 3,
          createdCell: function (td, cellData, rowData, row, col) {
            if (cellData === "0") {
              $(td).html('<div class="pending">Pending</div>');
            } else if (cellData === "1") {
              $(td).html('<div class="approved">Approved</div>');
            } else if (cellData === "2") {
              $(td).html('<div class="rejected">Rejected</div>');
            }
          },
        },
        {
          targets: [4, 5, 6, 7, 8, 9, 10],
          createdCell: function (td, cellData, rowData, row, col) {
            if (cellData === "1") {
              $(td).html('<p class="yes">Yes</p>');
            } else if (cellData === "0") {
              $(td).html('<p class="no">No</p>');
            } else if (cellData === "3") {
              $(td).html('<p class="leave">Leave</p>');
            }
          },
        },
        {
          targets: 11,
          data: null,
          createdCell: function (td, cellData, rowData, row, col) {
            $(td).html(
              `<i class="bi bi-box-arrow-up-left" onclick="viewDetails(${rowData[11]}, '${rowData[1]}')" data-bs-toggle="modal" data-bs-target="#exampleModal"></i>`
            );
          },
        },
        {
          targets: 12,
          data: null,
          createdCell: function (td, cellData, rowData, row, col) {
            let data = { id: rowData[11], status: rowData[2] };
            $(td).html(
              `<input type="checkbox" onchange='Change(event, ${JSON.stringify(
                data
              )})' value='${JSON.stringify(data)}'>`
            );
          },
        },
      ],
      drawCallback: function (settings) {
        if (settings["iDraw"] === 1) {
          getNames(); // Populate Name filter
        }

        $("#name").on("change", function () {
          $("#tab_temp_availability").DataTable().ajax.reload(); // Refresh table to filter records based on the selected Name
        });
      },
    });
  }

  // Adjust name filter based on the supervisor filter
  $("#supervisor").on("change", function () {
    $("#name").empty();
    getNames();
  });

  $("#day").on("change", function () {
    $("#tab_temp_availability").DataTable().ajax.reload();
  });

  // Handle next
  $("#next").on("click", function () {
    $("#day > option:selected").next().prop("selected", true);
    $("#tab_temp_availability").DataTable().ajax.reload();
  });

  // Handle previous
  $("#prev").on("click", function () {
    $("#day > option:selected").prev().prop("selected", true);
    $("#tab_temp_availability").DataTable().ajax.reload();
  });

  $("#checkAll").click(function () {
    $("input:checkbox").not(this).prop("checked", this.checked);

    $("input:checkbox").each(function (i) {
      if (i !== 0) {
        let checked = this.checked;
        let data = JSON.parse($(this).val());
        if (checked) {
          if (!values.includes(data)) {
            values.push(data);
          }
        } else {
          //
          var index = -1;
          values.find(function (item, i) {
            if (item.id === data.id) {
              index = i;
              return;
            }
          });

          if (index !== -1) {
            values.splice(index, 1);
          }
        }
      }
    });
  });

  function getNames() {
    $.ajax({
      type: "POST",
      url: "action/fetchNames.php",
      dataType: "json",
      data: {
        supervisor: $("#supervisor").val(),
      },
      success: function (data) {
        $("#name").append(
          $("<option>", {
            value: "",
            text: "",
          })
        );
        $(data["names"]).each(function (index) {
          $("#name").append(
            $("<option>", {
              value: this[0],
              text: this[1],
            })
          );
        });
      },
    });
  }
});

// Modal table
function viewDetails(id, name) {
  $.ajax({
    type: "POST",
    url: "action/fetch_all.php",
    dataType: "json",
    data: {
      tutor: id,
    },
    success: function (data) {
      /*
       * Create 5 tr nodes for 5 days.
       * Create 7 td nodes for 7 slots.
       * Append td nodes to relevant tr nodes.
       * Append tr nodes to tbody node.
       */
      $("#modalLabel").html("Availabilities for : " + name);
      $("#btn-submit").val(id);

      let tbody = $("#tab_fullAvailabilites").find("tbody");
      tbody.empty();
      let days = data["availabilities"];

      let monTr = $("<tr>");
      monTr.append($("<td>").append($("<p>").text("Monday")));
      $(days["monday"]).each(function (index) {
        monTr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", getAvailability(this[0]))
              .text(getAvbText(this[0]))
          )
        );
      });

      let tueTr = $("<tr>");
      tueTr.append($("<td>").append($("<p>").text("Tuesday")));
      $(days["tuesday"]).each(function (index) {
        tueTr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", this[0] === "0" ? "no" : "yes")
              .text(this[0] === "0" ? "No" : "Yes")
          )
        );
      });

      let wedTr = $("<tr>");
      wedTr.append($("<td>").append($("<p>").text("Wednesday")));
      $(days["wednesday"]).each(function (index) {
        wedTr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", this[0] === "0" ? "no" : "yes")
              .text(this[0] === "0" ? "No" : "Yes")
          )
        );
      });

      let thTr = $("<tr>");
      thTr.append($("<td>").append($("<p>").text("Thursday")));
      $(days["thursday"]).each(function (index) {
        thTr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", this[0] === "0" ? "no" : "yes")
              .text(this[0] === "0" ? "No" : "Yes")
          )
        );
      });

      let friTr = $("<tr>");
      friTr.append($("<td>").append($("<p>").text("Friday")));
      $(days["friday"]).each(function (index) {
        friTr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", this[0] === "0" ? "no" : "yes")
              .text(this[0] === "0" ? "No" : "Yes")
          )
        );
      });

      tbody.append(monTr, tueTr, wedTr, thTr, friTr);
    },
  });
}

this.values = []; // Selected entries
function Change(e, data) {
  const { checked } = e.target;

  if (checked) {
    if (!values.includes(data)) {
      values.push(data);
    }
  } else {
    //
    var index = -1;
    values.find(function (item, i) {
      if (item.id === data.id) {
        index = i;
        return;
      }
    });

    if (index !== -1) {
      values.splice(index, 1);
    }
  }
}

function getAvailability(avb) {
  if (avb === "0") {
    return "no";
  } else if (avb === "1") {
    return "yes";
  } else if (avb === "3") {
    return "leave";
  }
}
function getAvbText(avb) {
  if (avb === "0") {
    return "No";
  } else if (avb === "1") {
    return "Yes";
  } else if (avb === "3") {
    return "Leave";
  }
}
