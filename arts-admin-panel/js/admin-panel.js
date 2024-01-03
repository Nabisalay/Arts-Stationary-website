$(document).ready(function () {
  // this code is used to fetch employee
  function fetchemployees() {
    let tablebody = $("#employeetable");
    $.ajax({
      url: "fetchdata.php",
      type: "POST",
      data: { fetchEmployees: true },
      datatype: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          tablebody.empty();
          tablebody.append(res.tbody);
          if (!$.fn.DataTable.isDataTable("#example")) {
            $("#example").DataTable({
              scrollX: true,
              paging: false,
              scrollCollapse: true,
              scrollY: "200px",
            });
          }
          $("#example").DataTable();
        } else {
          console.error("unable to fetch the employees");
        }
      },
      error: function (err) {
        console.log("AJAX error", err);
      },
    });
  }
  // call to the function to get fetch employee on the load of the page

  // to block or unblock employees
  $(document).on("click", ".deleteEmp", function () {
    // get employee id
    let empId = $(this).data("empid");
    // get employee status e.g active or block
    let status = $(this).data("status");
    // Ajax request to block and unblock employee
    $.ajax({
      type: "POST",
      url: "update.php",
      data: { empid: empId, status: status },
      dataType: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          fetchemployees();
        } else {
          console.error("Status update failed");
        }
      },
      error: function (err) {
        console.log("AJAX error", err);
      },
    });
  });

  // this is to get the employee detail in the modal
  $(document).on("click", ".update-modal", function () {
    let uempId = $(this).data("uempid");
    let fname = $(this).data("ufname");
    let lname = $(this).data("ulname");
    let email = $(this).data("uemail");

    $("#eid").val(uempId);
    $("#upd-fname").val(fname);
    $("#upd-lname").val(lname);
    $("#upd-email").val(email);
  });

  //  this code is used to update the employee info
  $(document).on("click", "#updEmployee", function () {
    let employeeID = $("#eid").val();
    let updatedFName = $("#upd-fname").val();
    let updatedLName = $("#upd-lname").val();
    let updatedEmail = $("#upd-email").val();

    $.ajax({
      type: "POST",
      url: "update.php",
      data: {
        uempid: employeeID,
        fname: updatedFName,
        lname: updatedLName,
        email: updatedEmail,
      },
      dataType: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          $("#updatemodal").modal("hide");
          fetchemployees();
        } else {
          console.error("Status update failed");
        }
      },
      error: function (err) {
        console.log("AJAX error", err);
      },
    });
  });

  // this is used to fetch Products
  function fetchprod() {
    let tablebody = $("#prodTableBody");
    // let tablehead = $('#tableHead');
    $.ajax({
      url: "fetchdata.php",
      type: "POST",
      data: { fetchProd: true },
      datatype: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          tablebody.empty();
          // tablehead.empty();
          // tablehead.append(res.thead);
          tablebody.append(res.tbody);
          if (!$.fn.DataTable.isDataTable("#prodTables")) {
            $("#prodTables").DataTable({
              scrollX: true,
              paging: false,
              scrollCollapse: true,
              scrollY: "200px",
            });
          }
          $("#prodTables").DataTable();
        } else {
          console.error("Status update failed");
        }
      },
      error: function (err) {
        console.log("AJAX error", err);
      },
    });
  }

  // this is used to fetch category
  function fetchcat() {
    let tablebody = $("#catTableBody");
    // let tablehead = $('#tableHead');
    $.ajax({
      url: "fetchdata.php",
      type: "POST",
      data: { fetchCat: true },
      datatype: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          tablebody.empty();
          // tablehead.empty();
          // tablehead.append(res.thead);
          tablebody.append(res.tbody);
          if (!$.fn.DataTable.isDataTable("#catTables")) {
            $("#catTables").DataTable({
              scrollX: true,
              paging: false,
              scrollCollapse: true,
              scrollY: "200px",
              width: "200px",
            });
          }
          $("#catTables").DataTable();
        } else {
          console.error("Status update failed");
        }
      },
      error: function (err) {
        console.log("AJAX error", err);
      },
    });
  }

  // this is to check weather to fetch employee or products from server
  if (window.location.href.includes("viewemployee.php")) {
    fetchemployees();
  }
  if (window.location.href.includes("viewcat.php")) {
    fetchcat();
  }
  if (window.location.href.includes("viewprod.php")) {
    fetchprod();
  }

  // this is to restore the products from trash
  $(document).on("click", ".trash-product", function () {
    let prodId = $(this).data("prodid");
    let prodStatus = $(this).data("prodstatus");

    $.ajax({
      type: "POST",
      url: "update.php",
      data: { trashProduct: true, prodId: prodId, prodStatus: prodStatus },
      dataType: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          fetchprod();
        } else {
          console.error("Status update failed");
        }
      },
      error: function (err) {
        console.log("AJAX error", err.responseText);
      },
    });
  });

  function fetchData(url, data, tableBodySelector, dataTableSelector) {
    let tablebody = $(tableBodySelector);
    $.ajax({
      url: url,
      type: "POST",
      data: data,
      datatype: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          tablebody.empty();
          tablebody.append(res.tbody);
          if (!$.fn.DataTable.isDataTable(dataTableSelector)) {
            $(dataTableSelector).DataTable({
              scrollX: true,
              paging: false,
              scrollCollapse: true,
              scrollY: "200px",
            });
          }
          $(dataTableSelector).DataTable();
        } else {
          console.error("Status update failed");
        }
      },
      error: function (err) {
        console.log("AJAX error", err);
      },
    });
  }
  function fetchTrash() {
    let url = "fetchdata.php";
    let data = { fetchtrashProd: true };
    fetchData(url, data, "#trashcatTableBody", "#trashTables");
  }
  if (window.location.href.includes("prodTrash.php")) {
    fetchTrash();
  }

  // this code is used to restore the trash item
  $(document).on("click", ".restore-product", function () {
    let prodId = $(this).data("prodid");
    let prodStatus = $(this).data("prodstatus");
    let prodcode = $(this).data("prodcode");

    $.ajax({
      type: "POST",
      url: "update.php",
      data: {
        trashProduct: true,
        prodId: prodId,
        prodStatus: prodStatus,
        prodcode: prodcode,
      },
      dataType: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          alert(res.message);
          fetchTrash();
        } else {
            alert(res.message);
          console.error("Status update failed");
        }
      },
      error: function (err) {
        console.log("AJAX error", err.responseText);
      },
    });
  });

  // this is to get the prduct details in the modal
  $(document).on("click", ".updatePro-modal", function () {
    let upid = $(this).data("upid");
    let updes = $(this).data("updes");
    let upprice = $(this).data("upprice");
    let upwarrenty = $(this).data("upwarrenty");

    $("#upid").val(upid);
    $("#updes").val(updes);
    $("#upprice").val(upprice);
    $("#upwarrenty").val(upwarrenty);
  });

  //  this code is used to update the product info
  $(document).on("click", "#updProduct", function () {
    let upid = $("#upid").val();
    let updes = $("#updes").val();
    let upprice = $("#upprice").val();
    let upwarrenty = $("#upwarrenty").val();
    $.ajax({
      type: "POST",
      url: "update.php",
      data: {
        upid: upid,
        updes: updes,
        upprice: upprice,
        upwarrenty: upwarrenty,
      },
      dataType: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          $("#updateProdModal").modal("hide");
          fetchprod();
        } else {
          console.error("Status update failed");
        }
      },
      error: function (err) {
        console.log("AJAX error", err);
      },
    });
  });

  // this code is used to active or deactive the category
  $(document).on("click", ".catStatus", function () {
    let catid = $(this).data("catid");
    let catstatus = $(this).data("catstatus");

    $.ajax({
      type: "POST",
      url: "update.php",
      data: { activateCat: true, catid: catid, catstatus: catstatus },
      dataType: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          fetchcat();
        } else {
          console.error("Status update failed");
        }
      },
      error: function (err) {
        console.log("AJAX error", err.responseText);
      },
    });
  });

  // this is to get the category details in the modal
  $(document).on("click", ".updateCat-modal", function () {
    let catid = $(this).data("catid");
    let catName = $(this).data("catname");
    $("#catid").val(catid);
    $("#catName").val(catName);
  });

  //  this code is used to update the product info
  $(document).on("click", "#updCategory", function () {
    let catid = $("#catid").val();
    let catName = $("#catName").val();

    $.ajax({
      type: "POST",
      url: "update.php",
      data: { catuid: catid, catName: catName },
      dataType: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          $("#updateCatModal").modal("hide");
          fetchcat();
        } else {
          console.error("Status update failed");
        }
      },
      error: function (err) {
        console.log("AJAX error", err);
      },
    });
  });

  // this is to fetch user
  function fetchUsers() {
    let tablebody = $("#usertablebody");
    $.ajax({
      url: "fetchdata.php",
      type: "POST",
      data: { fetchUser: true },
      datatype: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          tablebody.empty();
          tablebody.append(res.tbody);
          if (!$.fn.DataTable.isDataTable("#usertable")) {
            $("#usertable").DataTable({
              scrollX: true,
              paging: false,
              scrollCollapse: true,
              scrollY: "200px",
            });
          }
          $("#usertable").DataTable();
        } else {
          console.error("unable to fetch the users");
        }
      },
      error: function (err) {
        console.log("AJAX error", err);
      },
    });
  }

  if (window.location.href.includes("viewUser.php")) {
    fetchUsers();
  }

  // to block or unblock employees
  $(document).on("click", ".deleteUser", function () {
    // get employee id
    let uid = $(this).data("uid");
    // get employee status e.g active or block
    let status = $(this).data("status");
    // Ajax request to block and unblock employee
    $.ajax({
      type: "POST",
      url: "update.php",
      data: { uid: uid, status: status },
      dataType: "json",
      success: function (res) {
        if (res.success) {
          console.log(res);
          fetchUsers();
        } else {
          console.error("Status update failed");
        }
      },
      error: function (err) {
        console.log("AJAX error", err);
      },
    });
  });

  if (window.location.href.includes("userProfile.php")) {
    function usersHistory() {
      let tablebody = $("#userHistrybody");
      let userEmail = $("#userEmail").text();
      console.log(userEmail);
      $.ajax({
        url: "fetchdata.php",
        type: "POST",
        data: { userHistory: true, userEmail: userEmail },
        datatype: "json",
        success: function (res) {
          if (res.success) {
            console.log(res);
            tablebody.empty();
            tablebody.append(res.tbody);
            if (!$.fn.DataTable.isDataTable("#userHistry")) {
              $("#userHistry").DataTable({
                scrollX: true,
                paging: false,
                scrollCollapse: true,
                scrollY: "200px",
              });
            }
            $("#userHistry").DataTable();
          } else {
            console.error("unable to fetch the users");
          }
        },
        error: function (err) {
          console.log("AJAX error", err);
        },
      });
    }
    usersHistory();
  }

  // for sending email after the order despatch

  function orderDispatched(url, email, orderid) {
    $.ajax({
      url: url,
      type: "POST",
      data: {
        orderDispatched: true,
        email: email,
        orderid: orderid
      },
      dataType: "json",
      success: function (res) {
        if (res.success) {
          console.log(res.message);
        } else {
          console.log(res.message);
        }
      },
      error: function (err) {
        console.log("AJAX error", err);
      },
    });
  }

  if (window.location.href.includes("orders.php")) {
    // this is used to fetch Products
    function fetchOrder() {
      let tablebody = $("#orderBody");
      let tablehead = $("#orderHead");
      $.ajax({
        url: "fetchdata.php",
        type: "POST",
        data: { fetchOrder: true },
        datatype: "json",
        success: function (res) {
          if (res.success) {
            console.log(res);
            tablebody.empty();
            tablehead.empty();
            tablehead.append(res.thead);
            tablebody.append(res.tbody);
            if (!$.fn.DataTable.isDataTable("#orderTable")) {
              $("#orderTable").DataTable({
                scrollX: true,
                paging: false,
                scrollCollapse: true,
                scrollY: "200px",
              });
            }
            $("#orderTable").DataTable();
          } else {
            console.error("Status update failed");
          }
        },
        error: function (err) {
          console.log("AJAX error", err);
        },
      });
    }

    // this is used to fetch category
    function fetchorderDetails() {
      let tablebody = $("#orderBody");
      let tablehead = $("#orderHead");
      $.ajax({
        url: "fetchdata.php",
        type: "POST",
        data: { orderedProducts: true },
        datatype: "json",
        success: function (res) {
          if (res.success) {
            console.log(res);
            tablebody.empty();
            tablehead.empty();
            tablehead.append(res.thead);
            tablebody.append(res.tbody);
            if (!$.fn.DataTable.isDataTable("#orderTable")) {
              $("#orderTable").DataTable({
                scrollX: true,
                paging: false,
                scrollCollapse: true,
                scrollY: "200px",
              });
            }
            $("#orderTable").DataTable();
          } else {
            console.error("Status update failed");
          }
        },
        error: function (err) {
          console.log("AJAX error", err);
        },
      });
    }
    fetchOrder();

    // this code is used to toggle between product and category from server
    $('input[name="orderResult"]').change(function () {
      let selectedValue = $('input[name="orderResult"]:checked').val();
      let mainHead = $("#mainHeading");
      mainHead.html("");
      if (selectedValue == "Order Details") {
        $("#orderTable").DataTable().clear().destroy();
        mainHead.html("Order Details");
        fetchorderDetails();
      } else if (selectedValue === "All Orders") {
        $("#orderTable").DataTable().clear().destroy();
        mainHead.html("All Orders");
        fetchOrder();
      }
    });



    $(document).on("click", ".dispatch", function () {
      console.log("clicked");
      let orderId = $(this).data("orderid");
      let email = $(this).data("email");
      let paymentMethod = $(this).data("paymentmethod");
      let paymentStatus = $(this).data("paymentstatus");
      $.ajax({
        url: "update.php",
        type: "POST",
        data: {
          dispatchOrder: true,
          OrderId: orderId,
          paymentMethod: paymentMethod,
          paymentStatus: paymentStatus,
        },
        dataType: "json",
        success: function (res) {
          if (res.success) {
            alert(res.message);
            console.log(res.id);
            fetchOrder();
            orderDispatched('update.php', email, orderId);
          } else {
            alert(res.message);
          }
        },
        error: function (err) {
          console.log("AJAX error", err);
        },
      });
    });
  }

  if (window.location.href.includes("employee-panel/index.php")) {
    // this is used to fetch Products
    function fetchOrder() {
      let tablebody = $("#orderBody");
      let tablehead = $("#orderHead");
      $.ajax({
        url: "../arts-admin-panel/fetchdata.php",
        type: "POST",
        data: { fetchOrder: true },
        datatype: "json",
        success: function (res) {
          if (res.success) {
            console.log(res);
            tablebody.empty();
            tablehead.empty();
            tablehead.append(res.thead);
            tablebody.append(res.tbody);
            if (!$.fn.DataTable.isDataTable("#orderTable")) {
              $("#orderTable").DataTable({
                scrollX: true,
                paging: false,
                scrollCollapse: true,
                scrollY: "200px",
              });
            }
            $("#orderTable").DataTable();
          } else {
            console.error("Status update failed");
          }
        },
        error: function (err) {
          console.log("AJAX error", err);
        },
      });
    }

    // this is used to fetch category
    function fetchorderDetails() {
      let tablebody = $("#orderBody");
      let tablehead = $("#orderHead");
      $.ajax({
        url: "../arts-admin-panel/fetchdata.php",
        type: "POST",
        data: { orderedProducts: true },
        datatype: "json",
        success: function (res) {
          if (res.success) {
            console.log(res);
            tablebody.empty();
            tablehead.empty();
            tablehead.append(res.thead);
            tablebody.append(res.tbody);
            if (!$.fn.DataTable.isDataTable("#orderTable")) {
              $("#orderTable").DataTable({
                scrollX: true,
                paging: false,
                scrollCollapse: true,
                scrollY: "200px",
              });
            }
            $("#orderTable").DataTable();
          } else {
            console.error("Status update failed");
          }
        },
        error: function (err) {
          console.log("AJAX error", err);
        },
      });
    }
    fetchOrder();

    // this code is used to toggle between product and category from server
    $('input[name="orderResult"]').change(function () {
      let selectedValue = $('input[name="orderResult"]:checked').val();
      let mainHead = $("#mainHeading");
      mainHead.html("");
      if (selectedValue == "Order Details") {
        $("#orderTable").DataTable().clear().destroy();
        mainHead.html("Order Details");
        fetchorderDetails();
      } else if (selectedValue === "All Orders") {
        $("#orderTable").DataTable().clear().destroy();
        mainHead.html("All Orders");
        fetchOrder();
      }
    });

    $(document).on("click", ".dispatch", function () {
      console.log("clicked");
      let orderId = $(this).data("orderid");
      let email = $(this).data("email");
      let paymentMethod = $(this).data("paymentmethod");
      let paymentStatus = $(this).data("paymentstatus");
      let url = "../arts-admin-panel/update.php";
      $.ajax({
        url: url,
        type: "POST",
        data: {
          dispatchOrder: true,
          OrderId: orderId,
          paymentMethod: paymentMethod,
          paymentStatus: paymentStatus,
        },
        dataType: "json",
        success: function (res) {
          if (res.success) {
            alert(res.message);
            console.log(res.id);
            fetchOrder();
            orderDispatched(url, email, orderId);
          } else {
            alert(res.message);
          }
        },
        error: function (err) {
          console.log("AJAX error", err);
        },
      });
    });
  }
});
