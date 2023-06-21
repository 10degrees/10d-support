jQuery(document).ready(function ($) {
  var generateReport = {
    init: function () {
      if ($("#js-generate-report").length) {
        $.ajax({
          type: "POST",
          url: ajaxurl,
          data: {
            action: "td_get_gt_metrix_report",
          },
          success: function (result) {
            $("#js-generate-report").html(result);
          },
          error: function (data) {
            console.log("error");
            console.log(data);
          },
        });
      }
    },
  };
  generateReport.init();

  function exportTableToCSV($table, filename) {
    var $rows = $table.find("tr:has(td)"),
      // Temporary delimiter characters unlikely to be typed by keyboard
      // This is to avoid accidentally splitting the actual contents
      tmpColDelim = String.fromCharCode(11), // vertical tab character
      tmpRowDelim = String.fromCharCode(0), // null character
      // actual delimiter characters for CSV format
      colDelim = '","',
      rowDelim = '"\r\n"',
      // Grab text from table into CSV formatted string
      csv =
        '"' +
        $rows
          .map(function (i, row) {
            var $row = $(row),
              $cols = $row.find("td");

            return $cols
              .map(function (j, col) {
                var $col = $(col),
                  text = $col.text();

                return text.replace(/"/g, '""'); // escape double quotes
              })
              .get()
              .join(tmpColDelim);
          })
          .get()
          .join(tmpRowDelim)
          .split(tmpRowDelim)
          .join(rowDelim)
          .split(tmpColDelim)
          .join(colDelim) +
        '"';

    console.log($rows);

    // Deliberate 'false', see comment below
    if (false && window.navigator.msSaveBlob) {
      var blob = new Blob([decodeURIComponent(csv)], {
        type: "text/csv;charset=utf8",
      });

      // Crashes in IE 10, IE 11 and Microsoft Edge
      // See MS Edge Issue #10396033
      // Hence, the deliberate 'false'
      // This is here just for completeness
      // Remove the 'false' at your own risk
      window.navigator.msSaveBlob(blob, filename);
    } else if (window.Blob && window.URL) {
      // HTML5 Blob
      var blob = new Blob([csv], {
        type: "text/csv;charset=utf-8",
      });
      var csvUrl = URL.createObjectURL(blob);

      $(this).attr({
        download: filename,
        href: csvUrl,
      });
    } else {
      // Data URI
      var csvData =
        "data:application/csv;charset=utf-8," + encodeURIComponent(csv);

      $(this).attr({
        download: filename,
        href: csvData,
        target: "_blank",
      });
    }
  }

  // This must be a hyperlink
  $(".tend-download-report-button").on("click", function (event) {
    // CSV
    var monthNames = [
      "January",
      "February",
      "March",
      "April",
      "May",
      "June",
      "July",
      "August",
      "September",
      "October",
      "November",
      "December",
    ];
    var d = new Date();
    var month = monthNames[d.getMonth()];
    var filename = month + "10degreesPluginReport.csv";
    var args = [
      $("#td_plugin_report_dashboard_widget table.plugin-update-table"),
      filename,
    ];

    exportTableToCSV.apply(this, args);

    // If CSV, don't do event.preventDefault() or return false
    // We actually need this to be a typical hyperlink
  });

  // Make it a click-to-call
  if ($(window).width() < 480) {
    $(".tend_nlc_chat").on("click", function () {
      $("a.tend_nlc_chat_content_call")[0].click();
    });

    // Otherwise show the form
  } else {
    $(".tend_nlc_chat_icon").click(function () {
      $(this).hide();
      $(".tend_nlc_chat_content").slideToggle("slow");
      $(".tend_nlc_chat").addClass("open");
    });
  }

  // Hide modal if there's a click on the close icon
  $(".tend_nlc_chat_close").click(function () {
    $(".tend_nlc_chat_content").slideToggle("slow", function () {
      $(".tend_nlc_chat_icon").show();
    });
    $(".tend_nlc_chat").removeClass("open");
  });

  // Hide the modal if there's a click on another part of the page
  $(document).mouseup(function (e) {
    var container = $(".tend_nlc_chat");
    if (container.hasClass("open")) {
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        // nor a descendant of the container
        $(".tend_nlc_chat_content").slideToggle("slow", function () {
          $(".tend_nlc_chat_icon").show();
        });
        $(".tend_nlc_chat").removeClass("open");
      }
    }
  });
});
