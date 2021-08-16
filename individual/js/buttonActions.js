function convertTableToForm(tableId) {
  $("#btn-submit").show();
  $("#btn-cancel").show();
  $("#btn-edit").hide();

  let table = $(`#${tableId}`);
  let tbody = table.find("tbody");

  table.find("tbody tr").each(function (i) {
    if (this.cells.length !== 0) {
      let firstColContent = this.children[0]["textContent"];

      if (firstColContent === "Slot 1") {
        for (let i = 1; i < 6; i++) {
          let id = getId(1, i);

          let availableOpt = this.children[i]["textContent"];

          let select = createSelectBox(id, availableOpt);

          $(this.children[i]).html(select);
        }
      } else if (firstColContent === "Slot 2") {
        for (let i = 1; i < 6; i++) {
          let id = getId(2, i);

          let availableOpt = this.children[i]["textContent"];

          let select = createSelectBox(id, availableOpt);

          $(this.children[i]).html(select);
        }
      } else if (firstColContent === "Slot 3") {
        for (let i = 1; i < 6; i++) {
          let id = getId(3, i);

          let availableOpt = this.children[i]["textContent"];

          let select = createSelectBox(id, availableOpt);

          $(this.children[i]).html(select);
        }
      } else if (firstColContent === "Slot 4") {
        for (let i = 1; i < 6; i++) {
          let id = getId(4, i);

          let availableOpt = this.children[i]["textContent"];

          let select = createSelectBox(id, availableOpt);

          $(this.children[i]).html(select);
        }
      } else if (firstColContent === "Slot 5") {
        for (let i = 1; i < 6; i++) {
          let id = getId(5, i);

          let availableOpt = this.children[i]["textContent"];

          let select = createSelectBox(id, availableOpt);

          $(this.children[i]).html(select);
        }
      } else if (firstColContent === "Slot 6") {
        for (let i = 1; i < 6; i++) {
          let id = getId(6, i);

          let availableOpt = this.children[i]["textContent"];

          let select = createSelectBox(id, availableOpt);

          $(this.children[i]).html(select);
        }
      } else if (firstColContent === "Slot 7") {
        for (let i = 1; i < 6; i++) {
          let id = getId(7, i);

          let availableOpt = this.children[i]["textContent"];

          let select = createSelectBox(id, availableOpt);

          $(this.children[i]).html(select);
        }
      }
    }
  });
}

$("#btn-cancel").click(function () {
  location.reload();
});

function saveUpdates() {
  let newAvailabilities = [];

  $("#tab_trial")
    .find("select")
    .each(function (i) {
      let obj = new Object();
      obj.id = $(this).attr("id");
      obj.value = $(this).val();

      newAvailabilities.push(obj);
    });

  let currDate = new Date(currentDate);
  let nextW = currDate.getDate() + 7;
  currDate.setDate(nextW);

  $.ajax({
    type: "POST",
    url: "action/updateAvailability.php",
    data: {
      items: JSON.stringify(newAvailabilities),
    },
    success: function (res) {
      location.reload();
    },
    error: function (errMsg) {
      console.error("error:", errMsg);
    },
  });
}

function createSelectBox(id, availableOpt) {
  let select = $("<select>").attr("class", "form-control").attr("id", id);

  let yes = $("<option>", { value: "yes" }).text("Yes");
  let no = $("<option>", { value: "no" }).text("No");

  if (availableOpt === "Yes") {
    select.append(yes);
  } else if (availableOpt === "No") {
    select.append(no);
  }

  let option = $("<option>", { value: "leave" }).text("Leave");

  select.append(option);

  return select;
}

function getId(c, r) {
  if (c === 1) {
    if (r === 1) return "m1";
    else if (r === 2) return "t1";
    else if (r === 3) return "w1";
    else if (r === 4) return "th1";
    else if (r === 5) return "f1";
  } else if (c === 2) {
    if (r === 1) return "m2";
    else if (r === 2) return "t2";
    else if (r === 3) return "w2";
    else if (r === 4) return "th2";
    else if (r === 5) return "f2";
  } else if (c === 3) {
    if (r === 1) return "m3";
    else if (r === 2) return "t3";
    else if (r === 3) return "w3";
    else if (r === 4) return "th3";
    else if (r === 5) return "f3";
  } else if (c === 4) {
    if (r === 1) return "m4";
    else if (r === 2) return "t4";
    else if (r === 3) return "w4";
    else if (r === 4) return "th4";
    else if (r === 5) return "f4";
  } else if (c === 5) {
    if (r === 1) return "m5";
    else if (r === 2) return "t5";
    else if (r === 3) return "w5";
    else if (r === 4) return "th5";
    else if (r === 5) return "f5";
  } else if (c === 6) {
    if (r === 1) return "m6";
    else if (r === 2) return "t6";
    else if (r === 3) return "w6";
    else if (r === 4) return "th6";
    else if (r === 5) return "f6";
  } else if (c === 7) {
    if (r === 1) return "m7";
    else if (r === 2) return "t7";
    else if (r === 3) return "w7";
    else if (r === 4) return "th7";
    else if (r === 5) return "f7";
  }
}
