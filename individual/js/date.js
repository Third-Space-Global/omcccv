$(".date-picker").datepicker({
  changeMonth: true,
  changeYear: true,
  showOn: "button",
  buttonImage: "./assets/calendar-week.svg",
  buttonImageOnly: true,
  showButtonPanel: true,
  onSelect: function (dateText, inst) {
    var date = $(this).datepicker("getDate");

    currentDate = new Date(date); // currentDate is used in Date picker in individual availabilities 

    let startDate = new Date(
      date.getFullYear(),
      date.getMonth(),
      date.getDate() - date.getDay()
    );
    let endDate = new Date(
      date.getFullYear(),
      date.getMonth(),
      date.getDate() - date.getDay() + 6
    );

    let week = {
      start: $.datepicker.formatDate("yy-mm-dd", startDate, inst.settings),
      end: $.datepicker.formatDate("yy-mm-dd", endDate, inst.settings),
    };

    let table = $("#tab_trial");

    table.find("tbody").empty();
    populateTable(week);

    $(this).val(
      $.datepicker.formatDate("dd MM", startDate, inst.settings) +
      " - " +
      $.datepicker.formatDate("dd MM", endDate, inst.settings)
    );
  },
});

function format(date) {
  var suffix = "";

  switch (inst.selectedDay) {
    case "1":
    case "21":
    case "31":
      suffix = "st";
      break;
    case "2":
    case "22":
      suffix = "nd";
      break;
    case "3":
    case "23":
      suffix = "rd";
      break;
    default:
      suffix = "th";
  }
}

function next() {
  let currDate = currentDate;
  let nextW = currDate.getDate() + 7;
  currDate.setDate(nextW);

  var first = currDate.getDate() - currDate.getDay() + 1;
  var last = first + 4;

  var firstday = new Date(currDate.setDate(first));
  var lastday = new Date(currDate.setDate(last));

  $(".date-picker").val(moment(firstday).format('DD MMMM') + " - " + moment(lastday).format('DD MMMM'));
  let week = {
    start: `${formatDate(firstday)}`,
    end: `${formatDate(lastday)}`
  }
  populateTable(week);
}

function prev() {
  let currDate = currentDate;
  let nextW = currDate.getDate() - 7;
  currDate.setDate(nextW);

  var first = currDate.getDate() - currDate.getDay() + 1;
  var last = first + 4;

  var firstday = new Date(currDate.setDate(first));
  var lastday = new Date(currDate.setDate(last));

  $(".date-picker").val(moment(firstday).format('DD MMMM') + " - " + moment(lastday).format('DD MMMM'));
  let week = {
    start: `${formatDate(firstday)}`,
    end: `${formatDate(lastday)}`
  }
  populateTable(week);
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