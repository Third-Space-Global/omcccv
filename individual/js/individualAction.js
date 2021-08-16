var currentDate;

$(function () {
  var curr = new Date;

  currentDate = new Date(curr);

  var first = curr.getDate() - curr.getDay() + 1;
  var last = first + 4;

  var firstday = new Date(curr.setDate(first));
  var lastday = new Date(curr.setDate(last));

  let week = {
    start: `${formatDate(firstday)}`,
    end: `${formatDate(lastday)}`
  }

  $("#btn-submit").hide();
  $("#btn-cancel").hide();
  $(".date-picker").val(moment(firstday).format('DD MMMM') + " - " + moment(lastday).format('DD MMMM'));
  populateTable(week);
});

function populateTable(week = { start: "", end: "" }) {
  $.ajax({
    type: "POST",
    url: "action/fetch.php",
    data: {
      week: JSON.stringify(week),
    },
    dataType: "json",
    success: function (data) {
      let tbody = $("#tab_trial").find("tbody");
      tbody.empty();
      let slots = data["availabilities"];

      let s1Tr = $("<tr>");
      s1Tr.append(
        $("<td>").append($("<p>").attr("class", "theader").text("Slot 1"))
      );
      $(slots["slot1"]).each(function (index) {
        s1Tr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", getAvailability(this[0]))
              .text(getAvbText(this[0]))
          )
        );
      });

      let s2Tr = $("<tr>");
      s2Tr.append(
        $("<td>").append($("<p>").attr("class", "theader").text("Slot 2"))
      );
      $(slots["slot2"]).each(function (index) {
        s2Tr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", getAvailability(this[0]))
              .text(getAvbText(this[0]))
          )
        );
      });

      let s3Tr = $("<tr>");
      s3Tr.append(
        $("<td>").append($("<p>").attr("class", "theader").text("Slot 3"))
      );
      $(slots["slot3"]).each(function (index) {
        s3Tr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", getAvailability(this[0]))
              .text(getAvbText(this[0]))
          )
        );
      });

      let s4Tr = $("<tr>");
      s4Tr.append(
        $("<td>").append($("<p>").attr("class", "theader").text("Slot 4"))
      );
      $(slots["slot4"]).each(function (index) {
        s4Tr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", getAvailability(this[0]))
              .text(getAvbText(this[0]))
          )
        );
      });

      let s5Tr = $("<tr>");
      s5Tr.append(
        $("<td>").append($("<p>").attr("class", "theader").text("Slot 5"))
      );
      $(slots["slot5"]).each(function (index) {
        s5Tr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", getAvailability(this[0]))
              .text(getAvbText(this[0]))
          )
        );
      });

      let s6Tr = $("<tr>");
      s6Tr.append(
        $("<td>").append($("<p>").attr("class", "theader").text("Slot 6"))
      );
      $(slots["slot6"]).each(function (index) {
        s6Tr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", getAvailability(this[0]))
              .text(this[0] === "0" ? "No" : "Yes")
          )
        );
      });

      let s7Tr = $("<tr>");
      s7Tr.append(
        $("<td>").append($("<p>").attr("class", "theader").text("Slot 7"))
      );
      $(slots["slot7"]).each(function (index) {
        s7Tr.append(
          $("<td>").append(
            $("<p>")
              .attr("class", getAvailability(this[0]))
              .text(getAvbText(this[0]))
          )
        );
      });

      tbody.append(s1Tr, s2Tr, s3Tr, s4Tr, s5Tr, s6Tr, s7Tr);
    },
    error: function (jqXhr, textStatus, errorMessage) {
      // error callback
      console.log(jqXhr);
    },
  });
}

function formatDate(date) {
  var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

  if (month.length < 2)
    month = '0' + month;
  if (day.length < 2)
    day = '0' + day;

  return [year, month, day].join('-');
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