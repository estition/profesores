<?php session_start(); ?>
<html>
<head>
<title>CANTERBURY -- entry</title>
<meta name="generator" content="text/html">
<style type="text/css">
  body {
    background-color: #FFFFFF;
    color: #004080;
    font-family: Arial;
    font-size: 12px;
  }
  .bd {
    background-color: #FFFFFF;
    color: #004080;
    font-family: Arial;
    font-size: 12px;
  }
  .tbl {
    background-color: #FFFFFF;
  }
  a:link { 
    color: #FF0000;
    font-family: Arial;
    font-size: 12px;
  }
  a:active { 
    color: #0000FF;
    font-family: Arial;
    font-size: 12px;
  }
  a:visited { 
    color: #800080;
    font-family: Arial;
    font-size: 12px;
  }
  .hr {
    background-color: #336699;
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
  }
  a.hr:link {
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
  }
  a.hr:active {
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
  }
  a.hr:visited {
    color: #FFFFFF;
    font-family: Arial;
    font-size: 12px;
  }
  .dr {
    background-color: #FFFFFF;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
  }
  .sr {
    background-color: #FFFFCF;
    color: #000000;
    font-family: Arial;
    font-size: 12px;
  }
</style>
</head>
<body>
<table class="bd" width="100%"><tr><td class="hr"><h2>GESTI�N HORAS</h2></td></tr></table>
<?php $conn = connect();
  $showrecs = 20;
  $pagerange = 10;

  $a = @$_GET["a"];
  $recid = @$_GET["recid"];
  
  $jbt_id = @$_GET["id"]; //######################################################################
  
  if (isset($_GET["order"])) $order = @$_GET["order"];
  if (isset($_GET["type"])) $ordtype = @$_GET["type"];

  if (isset($_POST["filter"])) $filter = @$_POST["filter"];
  if (isset($_POST["filter_field"])) $filterfield = @$_POST["filter_field"];
  $wholeonly = false;
  if (isset($_POST["wholeonly"])) $wholeonly = @$_POST["wholeonly"];

  if (!isset($order) && isset($_SESSION["order"])) $order = $_SESSION["order"];
  if (!isset($ordtype) && isset($_SESSION["type"])) $ordtype = $_SESSION["type"];
  if (!isset($filter) && isset($_SESSION["filter"])) $filter = $_SESSION["filter"];
  if (!isset($filterfield) && isset($_SESSION["filter_field"])) $filterfield = $_SESSION["filter_field"];

  $page = @$_GET["page"];
  if (!isset($page)) $page = 1;

  $sql = @$_POST["sql"];

  switch ($sql) {
    case "insert":
      sql_insert();
      break;
    case "update":
      sql_update();
      break;
    case "delete":
      sql_delete();
      break;
  }

  switch ($a) {
    case "add":
      addrec();
      break;
    case "view":
      viewrecJBT($recid,$jbt_id);//########################################################
      break;
    case "edit":
      editrecJBT($recid,$jbt_id);//########################################################
      break;
    case "del":
      deleterecJBT($recid,$jbt_id);//########################################################
      break;
    default:
      select();
      break;
  }

  if (isset($order)) $_SESSION["order"] = $order;
  if (isset($ordtype)) $_SESSION["type"] = $ordtype;
  if (isset($filter)) $_SESSION["filter"] = $filter;
  if (isset($filterfield)) $_SESSION["filter_field"] = $filterfield;
  if (isset($wholeonly)) $_SESSION["wholeonly"] = $wholeonly;

  mysql_close($conn);
?>
<table class="bd" width="100%"><tr><td class="hr">CANTERBURY ENGLISH</td></tr></table>
</body>
</html>

<?php function select()
  {
  global $a;
  global $showrecs;
  global $page;
  global $filter;
  global $filterfield;
  global $wholeonly;
  global $order;
  global $ordtype;


  if ($a == "reset") {
    $filter = "";
    $filterfield = "";
    $wholeonly = "";
    $order = "";
    $ordtype = "";
  }

  $checkstr = "";
  if ($wholeonly) $checkstr = " checked";
  if ($ordtype == "asc") { $ordtypestr = "desc"; } else { $ordtypestr = "asc"; }
  $res = sql_select();
  $count = sql_getrecordcount();
  if ($count % $showrecs != 0) {
    $pagecount = intval($count / $showrecs) + 1;
  }
  else {
    $pagecount = intval($count / $showrecs);
  }
  $startrec = $showrecs * ($page - 1);
  if ($startrec < $count) {mysql_data_seek($res, $startrec);}
  $reccount = min($showrecs * $page, $count);
  $fields = array(
    "id" => "id",
    "user_id" => "user_id",
    "class_type" => "class_type",
    "paysheet_id" => "paysheet_id",
    "group_id" => "group_id",
    "day" => "day",
    "concept_id" => "concept_id",
    "hours" => "hours",
    "observations" => "observations");
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr><td>Table: entry</td></tr>
<tr><td>Records shown <?php echo $startrec + 1 ?> - <?php echo $reccount ?> of <?php echo $count ?></td></tr>
</table>
<hr size="1" noshade>
<form action="entry.php" method="post">
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><b>Custom Filter</b>&nbsp;</td>
<td><input type="text" name="filter" value="<?php echo $filter ?>"></td>
<td><select name="filter_field">
<option value="">All Fields</option>
<?php reset($fields);
  foreach($fields as $val => $caption) {
    if ($val == $filterfield) {$selstr = " selected"; } else {$selstr = ""; }
?>
<option value="<?php echo $val ?>"<?php echo $selstr ?>><?php echo htmlspecialchars($caption) ?></option>
<?php } ?>
</select></td>
<td><input type="checkbox" name="wholeonly"<?php echo $checkstr ?>>Whole words only</td>
</td></tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="action" value="Apply Filter"></td>
<td><a href="entry.php?a=reset">Reset Filter</a></td>
</tr>
</table>
</form>
<hr size="1" noshade>
<?php showpagenav($page, $pagecount); ?>
<br>
<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="100%">
<tr>
<?php reset($fields);
  foreach($fields as $val => $caption) {
?>
<td class="hr"><a class="hr" href="entry.php?order=<?php echo $val ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars($caption) ?></a></td>
<?php } ?>
<td class="hr">&nbsp;</td>
<td class="hr">&nbsp;</td>
<td class="hr">&nbsp;</td>
</tr>
<?php for ($i = $startrec; $i < $reccount; $i++)
  {
    $row = mysql_fetch_assoc($res);
    $style = "dr";
    if ($i % 2 != 0) {
      $style = "sr";
    }
?>
<tr>
<?php reset($fields);
  foreach($fields as $val => $caption) { //###################################################################################
?>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row[$val]) ?></td>
<?php } ?>
<td class="<?php echo $style ?>"><a href="entry.php?a=view&recid=<?php echo $i ?>&id=<?php echo $row['id'] ?>">View</a></td>
<td class="<?php echo $style ?>"><a href="entry.php?a=edit&recid=<?php echo $i ?>&id=<?php echo $row['id'] ?>">Edit</a></td>
<td class="<?php echo $style ?>"><a href="entry.php?a=del&recid=<?php echo $i ?>&id=<?php echo $row['id'] ?>">Delete</a></td>
</tr>
<?php }
  mysql_free_result($res);
?>
</table>
<br>
<?php showpagenav($page, $pagecount); ?>
<?php } ?>

<?php function showrow($row)
  {
?>
<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="50%">
<tr>
<td class="hr"><?php echo htmlspecialchars("id")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["id"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("user_id")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["user_id"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("class_type")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["class_type"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("paysheet_id")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["paysheet_id"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("group_id")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["group_id"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("day")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["day"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("concept_id")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["concept_id"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("hours")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["hours"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("observations")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["observations"]) ?></td>
</tr>
</table>
<?php } ?>

<?php function showroweditor($row)
  {
  global $conn;
?>
<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="50%">
<tr>
<td class="hr"><?php echo htmlspecialchars("id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="id" value="<?php echo str_replace('"', '&quot;', trim($row["id"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("user_id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="user_id" value="<?php echo str_replace('"', '&quot;', trim($row["user_id"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("class_type")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="class_type" value="<?php echo str_replace('"', '&quot;', trim($row["class_type"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("paysheet_id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="paysheet_id" value="<?php echo str_replace('"', '&quot;', trim($row["paysheet_id"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("group_id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="group_id" value="<?php echo str_replace('"', '&quot;', trim($row["group_id"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("day")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="day" value="<?php echo str_replace('"', '&quot;', trim($row["day"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("concept_id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="concept_id" value="<?php echo str_replace('"', '&quot;', trim($row["concept_id"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("hours")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="hours" value="<?php echo str_replace('"', '&quot;', trim($row["hours"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("observations")."&nbsp;" ?></td>
<td class="dr"><textarea cols="35" rows="4" name="observations" maxlength="65535"><?php echo str_replace('"', '&quot;', trim($row["observations"])) ?></textarea></td>
</tr>
</table>
<?php } ?>

<?php function showpagenav($page, $pagecount)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="entry.php?a=add">Add Record</a>&nbsp;</td>
<?php if ($page > 1) { ?>
<td><a href="entry.php?page=<?php echo $page - 1 ?>">&lt;&lt;&nbsp;Prev</a>&nbsp;</td>
<?php } ?>
<?php global $pagerange;

  if ($pagecount > 1) {

  if ($pagecount % $pagerange != 0) {
    $rangecount = intval($pagecount / $pagerange) + 1;
  }
  else {
    $rangecount = intval($pagecount / $pagerange);
  }
  for ($i = 1; $i < $rangecount + 1; $i++) {
    $startpage = (($i - 1) * $pagerange) + 1;
    $count = min($i * $pagerange, $pagecount);

    if ((($page >= $startpage) && ($page <= ($i * $pagerange)))) {
      for ($j = $startpage; $j < $count + 1; $j++) {
        if ($j == $page) {
?>
<td><b><?php echo $j ?></b></td>
<?php } else { ?>
<td><a href="entry.php?page=<?php echo $j ?>"><?php echo $j ?></a></td>
<?php } } } else { ?>
<td><a href="entry.php?page=<?php echo $startpage ?>"><?php echo $startpage ."..." .$count ?></a></td>
<?php } } } ?>
<?php if ($page < $pagecount) { ?>
<td>&nbsp;<a href="entry.php?page=<?php echo $page + 1 ?>">Next&nbsp;&gt;&gt;</a>&nbsp;</td>
<?php } ?>
</tr>
</table>
<?php } ?>

<?php function showrecnav($a, $recid, $count)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="entry.php">Index Page</a></td>
<?php if ($recid > 0) { ?>
<td><a href="entry.php?a=<?php echo $a ?>&recid=<?php echo $recid - 1 ?>">Prior Record</a></td>
<?php } if ($recid < $count) { ?>
<td><a href="entry.php?a=<?php echo $a ?>&recid=<?php echo $recid + 1 ?>">Next Record</a></td>
<?php } ?>
</tr>
</table>
<hr size="1" noshade>
<?php } ?>

<?php function addrec()
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="entry.php">Index Page</a></td>
</tr>
</table>
<hr size="1" noshade>
<form action="entry.php" method="post">
<p><input type="hidden" name="sql" value="insert"></p>
<?php $row = array(
  "id" => "",
  "user_id" => "",
  "class_type" => "",
  "paysheet_id" => "",
  "group_id" => "",
  "day" => "",
  "concept_id" => "",
  "hours" => "",
  "observations" => "");
showroweditorJBT($row)//#########################################################################################
?>
<p><input type="submit" name="action" value="Post"></p>
</form>
<?php } ?>

<?php function viewrec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  mysql_data_seek($res, $recid);
  $row = mysql_fetch_assoc($res);
  showrecnav("view", $recid, $count);
?>
<br>
<?php showrow($row)  
?>
<br>
<hr size="1" noshade>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="entry.php?a=add">Add Record</a></td>
<td><a href="entry.php?a=edit&recid=<?php echo $recid ?>">Edit Record</a></td>
<td><a href="entry.php?a=del&recid=<?php echo $recid ?>">Delete Record</a></td>
</tr>
</table>
<?php mysql_free_result($res);
} ?>

<?php function editrec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  mysql_data_seek($res, $recid);
  $row = mysql_fetch_assoc($res);
  showrecnav("edit", $recid, $count);
?>
<br>
<form action="entry.php" method="post">
<input type="hidden" name="sql" value="update">
<input type="hidden" name="xid" value="<?php echo $row["id"] ?>">
<?php showroweditor($row) ?>
<p><input type="submit" name="action" value="Post"></p>
</form>
<?php mysql_free_result($res);
} ?>

<?php function deleterec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  mysql_data_seek($res, $recid);
  $row = mysql_fetch_assoc($res);
  showrecnav("del", $recid, $count);
?>
<br>
<form action="entry.php" method="post">
<input type="hidden" name="sql" value="delete">
<input type="hidden" name="xid" value="<?php echo $row["id"] ?>">
<?php showrow($row) ?>
<p><input type="submit" name="action" value="Confirm"></p>
</form>
<?php mysql_free_result($res);
} ?>

<?php function connect()
{
  $conn = mysql_connect("localhost", "Administrador", "hercules");
  mysql_select_db("canterburyproto");
  return $conn;
}

function sqlvalue($val, $quote)
{
  if ($quote)
    $tmp = sqlstr($val);
  else
    $tmp = $val;
  if ($tmp == "")
    $tmp = "NULL";
  elseif ($quote)
    $tmp = "'".$tmp."'";
  return $tmp;
}

function sqlstr($val)
{
  return str_replace("'", "''", $val);
}

function sql_select()
{
  global $conn;
  global $order;
  global $ordtype;
  global $filter;
  global $filterfield;
  global $wholeonly;

  $filterstr = sqlstr($filter);
  if (!$wholeonly && isset($wholeonly) && $filterstr!='') $filterstr = "%" .$filterstr ."%";
  $sql = "select `id`, `user_id`, `class_type`, `paysheet_id`, `group_id`, `day`, `concept_id`, `hours`, `observations` from `entry`";
  if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
    $sql .= " where " .sqlstr($filterfield) ." like '" .$filterstr ."'";
  } elseif (isset($filterstr) && $filterstr!='') {
    $sql .= " where (`id` like '" .$filterstr ."') or (`user_id` like '" .$filterstr ."') or (`class_type` like '" .$filterstr ."') or (`paysheet_id` like '" .$filterstr ."') or (`group_id` like '" .$filterstr ."') or (`day` like '" .$filterstr ."') or (`concept_id` like '" .$filterstr ."') or (`hours` like '" .$filterstr ."') or (`observations` like '" .$filterstr ."')";
  }
  if (isset($order) && $order!='') $sql .= " order by \"" .sqlstr($order) ."\"";
  if (isset($ordtype) && $ordtype!='') $sql .= " " .sqlstr($ordtype);
  $res = mysql_query($sql, $conn) or die(mysql_error());
  return $res;
}

function sql_getrecordcount()
{
  global $conn;
  global $order;
  global $ordtype;
  global $filter;
  global $filterfield;
  global $wholeonly;

  $filterstr = sqlstr($filter);
  if (!$wholeonly && isset($wholeonly) && $filterstr!='') $filterstr = "%" .$filterstr ."%";
  $sql = "select count(*) from `entry`";
  if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
    $sql .= " where " .sqlstr($filterfield) ." like '" .$filterstr ."'";
  } elseif (isset($filterstr) && $filterstr!='') {
    $sql .= " where (`id` like '" .$filterstr ."') or (`user_id` like '" .$filterstr ."') or (`class_type` like '" .$filterstr ."') or (`paysheet_id` like '" .$filterstr ."') or (`group_id` like '" .$filterstr ."') or (`day` like '" .$filterstr ."') or (`concept_id` like '" .$filterstr ."') or (`hours` like '" .$filterstr ."') or (`observations` like '" .$filterstr ."')";
  }
  $res = mysql_query($sql, $conn) or die(mysql_error());
  $row = mysql_fetch_assoc($res);
  reset($row);
  return current($row);
}

function sql_insert()
{
  global $conn;
  global $_POST;

  $sql = "insert into `entry` (`id`, `user_id`, `class_type`, `paysheet_id`, `group_id`, `day`, `concept_id`, `hours`, `observations`) values (" .sqlvalue(@$_POST["id"], false) .", " .sqlvalue(@$_POST["user_id"], false) .", " .sqlvalue(@$_POST["class_type"], false) .", " .sqlvalue(@$_POST["paysheet_id"], false) .", " .sqlvalue(@$_POST["group_id"], false) .", " .sqlvalue(@$_POST["day"], true) .", " .sqlvalue(@$_POST["concept_id"], false) .", " .sqlvalue(@$_POST["hours"], false) .", " .sqlvalue(@$_POST["observations"], true) .")";
  mysql_query($sql, $conn) or die(mysql_error());
}

function sql_update()
{
  global $conn;
  global $_POST;

  $sql = "update `entry` set `id`=" .sqlvalue(@$_POST["id"], false) .", `user_id`=" .sqlvalue(@$_POST["user_id"], false) .", `class_type`=" .sqlvalue(@$_POST["class_type"], false) .", `paysheet_id`=" .sqlvalue(@$_POST["paysheet_id"], false) .", `group_id`=" .sqlvalue(@$_POST["group_id"], false) .", `day`=" .sqlvalue(@$_POST["day"], true) .", `concept_id`=" .sqlvalue(@$_POST["concept_id"], false) .", `hours`=" .sqlvalue(@$_POST["hours"], false) .", `observations`=" .sqlvalue(@$_POST["observations"], true) ." where " ."(`id`=" .sqlvalue(@$_POST["xid"], false) .")";
  mysql_query($sql, $conn) or die(mysql_error());
}

function sql_delete()
{
  global $conn;
  global $_POST;

  $sql = "delete from `entry` where " ."(`id`=" .sqlvalue(@$_POST["xid"], false) .")";
  mysql_query($sql, $conn) or die(mysql_error());
} ?>



<?php //Funcion ver registro
//#####################################################################################
function viewrecJBT($recid,$parId)
{
  //$res = sql_select(); 
  $res = sql_selectJBT($parId); //########################
  $count = sql_getrecordcount();
  //mysql_data_seek($res, $recid); //########### jbt
  $row = mysql_fetch_assoc($res);
  //showrecnav("view", $recid, $count);
?>
<br>
<?php showrow($row) ?>
<br>

<?php mysql_free_result($res);
} 
//#########################################################################
?>

<?php //##############################################33 
function editrecJBT($recid,$parId)
{
  //$res = sql_select();
  $res = sql_selectJBT($parId); //########################
  $count = sql_getrecordcount();
  //mysql_data_seek($res, $recid);
  $row = mysql_fetch_assoc($res);
  //showrecnav("edit", $recid, $count);
?>
<br>
<form action="entry.php<?php echo $page?>" method="post">
<input type="hidden" name="sql" value="update">
<input type="hidden" name="xid" value="<?php echo $row["id"] ?>">
<?php showroweditor($row) ?>
<p><input type="submit" name="action" value="Post"></p>
</form>
<?php mysql_free_result($res);
} 
//######################################################################3
?>
<?php //######################################################## 
function deleterecJBT($recid,$parId)
{
  //$res = sql_select();
  $res = sql_selectJBT($parId); //########################
  $count = sql_getrecordcount();
  //mysql_data_seek($res, $recid);
  $row = mysql_fetch_assoc($res);
  //showrecnav("del", $recid, $count);
?>
<br>
<form action="entry.php?page=<?php echo $page?>" method="post">
<input type="hidden" name="sql" value="delete">
<input type="hidden" name="xid" value="<?php echo $row["id"] ?>">
<?php showrow($row) ?>
<p><input type="submit" name="action" value="Confirm"></p>
</form>
<?php mysql_free_result($res);
} 
//################################################################

//################################################################
function sql_selectJBT($parId)
{
  global $conn;
  global $order;
  global $ordtype;
  global $filter;
  global $filterfield;
  global $wholeonly;

  //$filterstr = sqlstr($filter);
  //if (!$wholeonly && isset($wholeonly) && $filterstr!='') $filterstr = "%" .$filterstr ."%";
  //$sql = "select `id`, `old_id`, `group_id`, `name`, `telephone1`, `telephone2`, `mobile`, `fax`, `email`, `address1`, `address2`, `city`, `state`, `zip` from `clients`";
  //if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
    //$sql .= " where " .sqlstr($filterfield) ." like '" .$filterstr ."'";
  //} elseif (isset($filterstr) && $filterstr!='') {
    //$sql .= " where (`id` like '" .$filterstr ."') or (`old_id` like '" .$filterstr ."') or (`group_id` like '" .$filterstr ."') or (`name` like '" .$filterstr ."') or (`telephone1` like '" .$filterstr ."') or (`telephone2` like '" .$filterstr ."') or (`mobile` like '" .$filterstr ."') or (`fax` like '" .$filterstr ."') or (`email` like '" .$filterstr ."') or (`address1` like '" .$filterstr ."') or (`address2` like '" .$filterstr ."') or (`city` like '" .$filterstr ."') or (`state` like '" .$filterstr ."') or (`zip` like '" .$filterstr ."')";
  //}
  //if (isset($order) && $order!='') $sql .= " order by \"" .sqlstr($order) ."\"";
  //if (isset($ordtype) && $ordtype!='') $sql .= " " .sqlstr($ordtype);
  //$sql = "select `id`, `old_id`, `group_id`, `name`, `telephone1`, `telephone2`, `mobile`, `fax`, `email`, `address1`, `address2`, `city`, `state`, `zip` from `groups` where id=".$parId;
  //$sql = "select `id`, `old_id`, `name`, `cif`, `telephone1`, `telephone2`, `mobile`, `fax`, `email`, `address1`, `address2`, `city`, `state`, `zip`, `start`, `end`, `supplement`, `class_type` from `groups` where id=".$parId;
  //$sql = "select `id`, `user_id`, `length`, `group_id`, `start`, `end` from `usergroup` where id=".$parId;
  //$sql = "select `id`, `old_id`, `user_id`, `password`, `is_admin`, `is_active`, `changePassword`, `first`, `last1`, `last2`, `country`, `telephone1`, `telephone2`, `mobile`, `email`, `address1`, `address2`, `city`, `state`, `zip` from `users` where id=".$parId;
  $sql = "select `id`, `user_id`, `class_type`, `paysheet_id`, `group_id`, `day`, `concept_id`, `hours`, `observations` from `entry`  where id=".$parId;

   
  $res = mysql_query($sql, $conn) or die(mysql_error());
  return $res;
}
?>

<?php //######################################################################
 function DameUltimoMasUno()
     {
	 global $conn;
//////////////////////////////
			$sql = 'SELECT id FROM entry ORDER BY id desc'; //where ".$searchtype." like '%".$searchterm."%'";
   		    
			//print 'cccccccccccccccccccccccccc';
			
  			$rs = mysql_query($sql, $conn);//mysql_query($sql);
		
  			$fila = mysql_fetch_row($rs);
			
			$NumeroRegistros = mysql_num_rows($rs);
	   //////////////////////////////
	   
	   //print $sql;
	   
	   //for($i=0; $i<$NumeroRegistros; $i++)
				//{
				$str=$fila[0];
				$str=$str+1;
				
				//$fila = mysql_fetch_row($rs);
				//}

       mysql_free_result($rs);
	   
	   return $str;
	 }
	
	//######################################################################
 function DameUltimoMasUno2()
     {
	 global $conn;
//////////////////////////////
			$sql = 'SELECT old_id FROM entry ORDER BY id desc'; //where ".$searchtype." like '%".$searchterm."%'";
   		    
			//print 'cccccccccccccccccccccccccc';
			
  			$rs = mysql_query($sql, $conn);//mysql_query($sql);
		
  			$fila = mysql_fetch_row($rs);
			
			$NumeroRegistros = mysql_num_rows($rs);
	   //////////////////////////////
	   
	   //print $sql;
	   
	   //for($i=0; $i<$NumeroRegistros; $i++)
				//{
				$str=$fila[0];
				$str=$str+1;
				
				//$fila = mysql_fetch_row($rs);
				//}

       mysql_free_result($rs);
	   
	   return $str;
	 }
	 
	   
?> 


<?php //###################################################################################
  function DameSelects($sql)
     {
	 global $conn;
//////////////////////////////
			//$sql = 'SELECT id,user_id,first,last1,last2 FROM users ORDER BY last1,first'; //where ".$searchtype." like '%".$searchterm."%'";
   		    
			//print 'cccccccccccccccccccccccccc';
			
  			$rs = mysql_query($sql, $conn);//mysql_query($sql);
		
  			$fila = mysql_fetch_row($rs);
			
			$NumeroRegistros = mysql_num_rows($rs);
	   //////////////////////////////
	   
	   //print $sql;
	   
	   for($i=0; $i<$NumeroRegistros; $i++)
				{
				$str=$str.'<option value="'.$fila[0].'">'.$fila[3].' '.$fila[2].'</option>';
				
				$fila = mysql_fetch_row($rs);
				}

       mysql_free_result($rs);
	   
	   return $str;
	 } ?>	 
	
	
	
  <?php //######################################################################################### 
  function showroweditorJBT($row)
  {
  global $conn;
?>
<script language="JavaScript" type="text/JavaScript">
   function PonerId()  {
	  document.getElementById("user_id").value=document.getElementById("select1").value;
	  }
	function PonerId2()  {
	  document.getElementById("concept_id").value=document.getElementById("select2").value;
	  }
	  function PonerId3()  {
	  document.getElementById("group_id").value=document.getElementById("selectGroups").value;
	  }  
  </script>
<table class="tbl" border="0" cellspacing="1" cellpadding="5"width="50%">
<tr>
<td class="hr"><?php echo htmlspecialchars("id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="id" value="<?php echo DameUltimoMasUno() ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("user_id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="user_id" value="<?php echo str_replace('"', '&quot;', trim($row["user_id"])) ?>"></td>
<td class="dr"><select name="select1" id="select1" onChange="PonerId()">
<?php echo DameSelects('SELECT id,user_id,first,last1,last2 FROM users ORDER BY last1,first');		
?>
</select></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("class_type")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="class_type" value="<?php echo str_replace('"', '&quot;', trim($row["class_type"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("paysheet_id (no se usa)")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="paysheet_id" value="<?php echo str_replace('"', '&quot;', trim($row["paysheet_id"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("group_id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="group_id" value="<?php echo str_replace('"', '&quot;', trim($row["group_id"])) ?>"></td>
<td class="dr"><select name="selectGroups" id="selectGroups" onChange="PonerId3()">
<?php echo DameSelects('select id,old_id,name from groups ORDER BY name');		
?>
</select></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("day")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="day" value="<?php echo str_replace('"', '&quot;', trim($row["day"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("concept_id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="concept_id" value="<?php echo str_replace('"', '&quot;', trim($row["concept_id"])) ?>"></td>
<td class="dr"><select name="select2" id="select2" onChange="PonerId2()">
<?php echo DameSelects('select id,id,concept from concepts ORDER BY concept');		
?>
</select></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("hours")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="hours" value="<?php echo str_replace('"', '&quot;', trim($row["hours"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("observations")."&nbsp;" ?></td>
<td class="dr"><textarea cols="35" rows="4" name="observations" maxlength="65535"><?php echo str_replace('"', '&quot;', trim($row["observations"])) ?></textarea></td>
</tr>
</table>
<?php } ?> 