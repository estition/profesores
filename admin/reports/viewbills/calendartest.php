<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<script type="text/javascript" src="grid/calendar/JSCal2-1.9/src/js/jscal2.js"></script>
<script type="text/javascript" src="grid/calendar/JSCal2-1.9/src/js/lang/en.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="grid/calendar/JSCal2-1.9/src/css/jscal2.css"  />
<link rel="stylesheet" type="text/css" href="grid/calendar/JSCal2-1.9/src/css/border-radius.css" />
<link rel="stylesheet" type="text/css" href="grid/calendar/JSCal2-1.9/src/css/steel/steel.css" />
</head>

<body>


<table>
      <tr>
        <td style="width: 20em">
          <div id="cont"></div>
          <div id="info" style="text-align: center; margin-top: 1em;">Click to select start date</div>
        </td>
      </tr>
    </table>
 
  <script type="text/javascript">//<![CDATA[

      var SELECTED_RANGE = null;
      function getSelectionHandler() {
              var startDate = null;
              var ignoreEvent = false;
              return function(cal) {
                      var selectionObject = cal.selection;

                      // avoid recursion, since selectRange triggers onSelect
                      if (ignoreEvent)
                              return;

                      var selectedDate = selectionObject.get();
                      if (startDate == null) {
                              startDate = selectedDate;
                              SELECTED_RANGE = null;
                              document.getElementById("info").innerHTML = "Click to select end date";

                              // comment out the following two lines and the ones marked (*) in the else branch
                              // if you wish to allow selection of an older date (will still select range)
                              cal.args.min = Calendar.intToDate(selectedDate);
                              cal.refresh();
                      } else {
                              ignoreEvent = true;
                              selectionObject.selectRange(startDate, selectedDate);
                              ignoreEvent = false;
                              SELECTED_RANGE = selectionObject.sel[0];

                              // alert(SELECTED_RANGE.toSource());
                              //
                              // here SELECTED_RANGE contains two integer numbers: start date and end date.
                              // you can get JS Date objects from them using Calendar.intToDate(number)

                              startDate = null;
                              document.getElementById("info").innerHTML = selectionObject.print("%Y-%m-%d") +
                                      "<br />Click again to select new start date";

                              // (*)
                              cal.args.min = null;
                              cal.refresh();
                      }
              };
      };

      Calendar.setup({
              cont          : "cont",
              fdow          : 1,
			  selectionType : Calendar.SEL_SINGLE,
              onSelect      : getSelectionHandler()
      });

    //]]></script>

</body>
</html>