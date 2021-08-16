$(function () {
  $("#dropdownMenuButton1").on("click", function () {
    let approve = `<li><a class="dropdown-item" href="#" onclick="bulkAction(1)">Approve</a></li>`;
    let reject = `<li><a class="dropdown-item" href="#" onclick="bulkAction(2)">Reject</a></li>`;

    $("#dp_menu").empty();
    if (values.length > 1) {
      $("#dp_menu").append(approve);
    } else {
      $("#dp_menu").append(approve);
      $("#dp_menu").append(reject);
    }
  });

  $("#clear-filters").on("click", function () {
    $("#supervisor").prop("selectedIndex", 0);
    $("#name").prop("selectedIndex", 0);

    $("#tab_temp_availability").DataTable().ajax.reload();
  });
});

function bulkAction(action) {

  let items = values;
  $.ajax({
    type: "POST",
    url: "action/bulkAction.php",
    data: {
      items: JSON.stringify(items),
      action: action,
    },
    success: function (res) {
      location.reload();
    },
    error: function (errMsg) {
      console.error("error:", errMsg);
    },
  });
}

function createSelectBox(id) {
  let select = $("<select>").attr("class", "form-control").prop("id", id);

  select.append($("<option>").prop("value", "yes").text("Yes"));
  select.append($("<option>").prop("value", "no").text("No"));

  return select;
}

function convertTableToForm(tableId) {
  $("#btn-submit").show();
  let table = $(`#${tableId}`);

  table.find("tbody tr").each(function (i) {
    let firstColContent = this.children[0]["textContent"];

    if (firstColContent === "Monday") {
      for (let i = 1; i < 8; i++) {
        let tdContent = this.children[i]["textContent"];

        let id = "m" + i;

        let select = createSelectBox(id);
        select.prop("selectedIndex", tdContent === "Yes" ? 0 : 1);

        $(this.children[i]).html(select);
      }
    } else if (firstColContent === "Tuesday") {
      for (let i = 1; i < 8; i++) {
        let tdContent = this.children[i]["textContent"];

        let id = "t" + i;

        let select = createSelectBox(id);
        select.prop("selectedIndex", tdContent === "Yes" ? 0 : 1);

        $(this.children[i]).html(select);
      }
    } else if (firstColContent === "Wednesday") {
      for (let i = 1; i < 8; i++) {
        let tdContent = this.children[i]["textContent"];

        let id = "w" + i;

        let select = createSelectBox(id);
        select.prop("selectedIndex", tdContent === "Yes" ? 0 : 1);

        $(this.children[i]).html(select);
      }
    } else if (firstColContent === "Thursday") {
      for (let i = 1; i < 8; i++) {
        let tdContent = this.children[i]["textContent"];

        let id = "th" + i;

        let select = createSelectBox(id);
        select.prop("selectedIndex", tdContent === "Yes" ? 0 : 1);

        $(this.children[i]).html(select);
      }
    } else if (firstColContent === "Friday") {
      for (let i = 1; i < 8; i++) {
        let tdContent = this.children[i]["textContent"];

        let id = "f" + i;

        let select = createSelectBox(id);
        select.prop("selectedIndex", tdContent === "Yes" ? 0 : 1);

        $(this.children[i]).html(select);
      }
    }
  });
}

function saveUpdates() {
  let newAvailabilities = [];

  $("#tab_fullAvailabilites")
    .find("select")
    .each(function (i) {
      let obj = new Object();
      obj.id = $(this).attr("id");
      obj.value = $(this).val();

      newAvailabilities.push(obj);
    });

  $.ajax({
    type: "POST",
    url: "action/updateAvailability.php",
    data: {
      items: JSON.stringify(newAvailabilities),
      id: $("#btn-submit").val(),
    },
    success: function (res) {
      location.reload();
    },
    error: function (errMsg) {
      console.error("error:", errMsg);
    },
  });
}
