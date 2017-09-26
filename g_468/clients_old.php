<?php session_start(); ?>
<html>
<head>
<title>CANTERBURY -- clients</title>
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
<table class="bd" width="100%"><tr><td class="hr"><h2>PHP Generator</h2></td></tr></table>
<?php $conn = connect();
  $showrecs = 20;
  $pagerange = 10;

  $a = @$_GET["a"];
  $recid = @$_GET["recid"];
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
      viewrec($recid);
      break;
    case "edit":
      editrec($recid);
      break;
    case "del":
      deleterec($recid);
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
<table class="bd" width="100%"><tr><td class="hr">http://www.sqlmaestro.com/products/mysql/phpgenerator/</td></tr></table>
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
    "old_id" => "old_id",
    "group_id" => "group_id",
    "name" => "name",
    "telephone1" => "telephone1",
    "telephone2" => "telephone2",
    "mobile" => "mobile",
    "fax" => "fax",
    "email" => "email",
    "address1" => "address1",
    "address2" => "address2",
    "city" => "city",
    "state" => "state",
    "zip" => "zip");
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr><td>Table: clients</td></tr>
<tr><td>Records shown <?php echo $startrec + 1 ?> - <?php echo $reccount ?> of <?php echo $count ?></td></tr>
</table>
<hr size="1" noshade>
<form action="clients.php" method="post">
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
<td><a href="clients.php?a=reset">Reset Filter</a></td>
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
<td class="hr"><a class="hr" href="clients.php?order=<?php echo $val ?>&type=<?php echo $ordtypestr ?>"><?php echo htmlspecialchars($caption) ?></a></td>
<?php } ?>
<td class="hr">&nbsp;</td>
<td class="hr">&nbsp;</td>
<td class="hr">&nbsp;</td>
</tr>
<?php for ($i = $startrec; $i < $reccount; $i++)
  {
    $row = mysqli_fetch_assoc($res);
    $style = "dr";
    if ($i % 2 != 0) {
      $style = "sr";
    }
?>
<tr>
<?php reset($fields);
  foreach($fields as $val => $caption) {
?>
<td class="<?php echo $style ?>"><?php echo htmlspecialchars($row[$val]) ?></td>
<?php } ?>
<td class="<?php echo $style ?>"><a href="clients.php?a=view&recid=<?php echo $i ?>">View</a></td>
<td class="<?php echo $style ?>"><a href="clients.php?a=edit&recid=<?php echo $i ?>">Edit</a></td>
<td class="<?php echo $style ?>"><a href="clients.php?a=del&recid=<?php echo $i ?>">Delete</a></td>
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
<td class="hr"><?php echo htmlspecialchars("old_id")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["old_id"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("group_id")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["group_id"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("name")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["name"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("telephone1")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["telephone1"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("telephone2")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["telephone2"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("mobile")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["mobile"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("fax")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["fax"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("email")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["email"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("address1")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["address1"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("address2")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["address2"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("city")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["city"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("state")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["state"]) ?></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("zip")."&nbsp;" ?></td>
<td class="dr"><?php echo htmlspecialchars($row["zip"]) ?></td>
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
<td class="hr"><?php echo htmlspecialchars("old_id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="old_id" value="<?php echo str_replace('"', '&quot;', trim($row["old_id"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("group_id")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="group_id" value="<?php echo str_replace('"', '&quot;', trim($row["group_id"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("name")."&nbsp;" ?></td>
<td class="dr"><textarea cols="35" rows="4" name="name" maxlength="100"><?php echo str_replace('"', '&quot;', trim($row["name"])) ?></textarea></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("telephone1")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="telephone1" maxlength="50" value="<?php echo str_replace('"', '&quot;', trim($row["telephone1"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("telephone2")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="telephone2" maxlength="50" value="<?php echo str_replace('"', '&quot;', trim($row["telephone2"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("mobile")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="mobile" maxlength="50" value="<?php echo str_replace('"', '&quot;', trim($row["mobile"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("fax")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="fax" maxlength="50" value="<?php echo str_replace('"', '&quot;', trim($row["fax"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("email")."&nbsp;" ?></td>
<td class="dr"><textarea cols="35" rows="4" name="email" maxlength="100"><?php echo str_replace('"', '&quot;', trim($row["email"])) ?></textarea></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("address1")."&nbsp;" ?></td>
<td class="dr"><textarea cols="35" rows="4" name="address1" maxlength="100"><?php echo str_replace('"', '&quot;', trim($row["address1"])) ?></textarea></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("address2")."&nbsp;" ?></td>
<td class="dr"><textarea cols="35" rows="4" name="address2" maxlength="100"><?php echo str_replace('"', '&quot;', trim($row["address2"])) ?></textarea></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("city")."&nbsp;" ?></td>
<td class="dr"><textarea cols="35" rows="4" name="city" maxlength="100"><?php echo str_replace('"', '&quot;', trim($row["city"])) ?></textarea></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("state")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="state" maxlength="50" value="<?php echo str_replace('"', '&quot;', trim($row["state"])) ?>"></td>
</tr>
<tr>
<td class="hr"><?php echo htmlspecialchars("zip")."&nbsp;" ?></td>
<td class="dr"><input type="text" name="zip" maxlength="20" value="<?php echo str_replace('"', '&quot;', trim($row["zip"])) ?>"></td>
</tr>
</table>
<?php } ?>

<?php function showpagenav($page, $pagecount)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="clients.php?a=add">Add Record</a>&nbsp;</td>
<?php if ($page > 1) { ?>
<td><a href="clients.php?page=<?php echo $page - 1 ?>">&lt;&lt;&nbsp;Prev</a>&nbsp;</td>
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
<td><a href="clients.php?page=<?php echo $j ?>"><?php echo $j ?></a></td>
<?php } } } else { ?>
<td><a href="clients.php?page=<?php echo $startpage ?>"><?php echo $startpage ."..." .$count ?></a></td>
<?php } } } ?>
<?php if ($page < $pagecount) { ?>
<td>&nbsp;<a href="clients.php?page=<?php echo $page + 1 ?>">Next&nbsp;&gt;&gt;</a>&nbsp;</td>
<?php } ?>
</tr>
</table>
<?php } ?>

<?php function showrecnav($a, $recid, $count)
{
?>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="clients.php">Index Page</a></td>
<?php if ($recid > 0) { ?>
<td><a href="clients.php?a=<?php echo $a ?>&recid=<?php echo $recid - 1 ?>">Prior Record</a></td>
<?php } if ($recid < $count) { ?>
<td><a href="clients.php?a=<?php echo $a ?>&recid=<?php echo $recid + 1 ?>">Next Record</a></td>
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
<td><a href="clients.php">Index Page</a></td>
</tr>
</table>
<hr size="1" noshade>
<form action="clients.php" method="post">
<p><input type="hidden" name="sql" value="insert"></p>
<?php $row = array(
  "id" => "",
  "old_id" => "",
  "group_id" => "",
  "name" => "",
  "telephone1" => "",
  "telephone2" => "",
  "mobile" => "",
  "fax" => "",
  "email" => "",
  "address1" => "",
  "address2" => "",
  "city" => "",
  "state" => "",
  "zip" => "");
showroweditor($row)
?>
<p><input type="submit" name="action" value="Post"></p>
</form>
<?php } ?>

<?php function viewrec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  mysql_data_seek($res, $recid);
  $row = mysqli_fetch_assoc($res);
  showrecnav("view", $recid, $count);
?>
<br>
<?php showrow($row) ?>
<br>
<hr size="1" noshade>
<table class="bd" border="0" cellspacing="1" cellpadding="4">
<tr>
<td><a href="clients.php?a=add">Add Record</a></td>
<td><a href="clients.php?a=edit&recid=<?php echo $recid ?>">Edit Record</a></td>
<td><a href="clients.php?a=del&recid=<?php echo $recid ?>">Delete Record</a></td>
</tr>
</table>
<?php mysql_free_result($res);
} ?>

<?php function editrec($recid)
{
  $res = sql_select();
  $count = sql_getrecordcount();
  mysql_data_seek($res, $recid);
  $row = mysqli_fetch_assoc($res);
  showrecnav("edit", $recid, $count);
?>
<br>
<form action="clients.php" method="post">
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
  $row = mysqli_fetch_assoc($res);
  showrecnav("del", $recid, $count);
?>
<br>
<form action="clients.php" method="post">
<input type="hidden" name="sql" value="delete">
<input type="hidden" name="xid" value="<?php echo $row["id"] ?>">
<?php showrow($row) ?>
<p><input type="submit" name="action" value="Confirm"></p>
</form>
<?php mysql_free_result($res);
} ?>

<?php function connect()
{
  $conn = mysql_connect("localhost", "root", "");
  mysql_select_db("CANTERBURY");
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
  $sql = "select `id`, `old_id`, `group_id`, `name`, `telephone1`, `telephone2`, `mobile`, `fax`, `email`, `address1`, `address2`, `city`, `state`, `zip` from `clients`";
  if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
    $sql .= " where " .sqlstr($filterfield) ." like '" .$filterstr ."'";
  } elseif (isset($filterstr) && $filterstr!='') {
    $sql .= " where (`id` like '" .$filterstr ."') or (`old_id` like '" .$filterstr ."') or (`group_id` like '" .$filterstr ."') or (`name` like '" .$filterstr ."') or (`telephone1` like '" .$filterstr ."') or (`telephone2` like '" .$filterstr ."') or (`mobile` like '" .$filterstr ."') or (`fax` like '" .$filterstr ."') or (`email` like '" .$filterstr ."') or (`address1` like '" .$filterstr ."') or (`address2` like '" .$filterstr ."') or (`city` like '" .$filterstr ."') or (`state` like '" .$filterstr ."') or (`zip` like '" .$filterstr ."')";
  }
  if (isset($order) && $order!='') $sql .= " order by \"" .sqlstr($order) ."\"";
  if (isset($ordtype) && $ordtype!='') $sql .= " " .sqlstr($ordtype);
  $res = mysqli_query($link, $sql, $conn) or die(mysqli_error($link));
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
  $sql = "select count(*) from `clients`";
  if (isset($filterstr) && $filterstr!='' && isset($filterfield) && $filterfield!='') {
    $sql .= " where " .sqlstr($filterfield) ." like '" .$filterstr ."'";
  } elseif (isset($filterstr) && $filterstr!='') {
    $sql .= " where (`id` like '" .$filterstr ."') or (`old_id` like '" .$filterstr ."') or (`group_id` like '" .$filterstr ."') or (`name` like '" .$filterstr ."') or (`telephone1` like '" .$filterstr ."') or (`telephone2` like '" .$filterstr ."') or (`mobile` like '" .$filterstr ."') or (`fax` like '" .$filterstr ."') or (`email` like '" .$filterstr ."') or (`address1` like '" .$filterstr ."') or (`address2` like '" .$filterstr ."') or (`city` like '" .$filterstr ."') or (`state` like '" .$filterstr ."') or (`zip` like '" .$filterstr ."')";
  }
  $res = mysqli_query($link, $sql, $conn) or die(mysqli_error($link));
  $row = mysqli_fetch_assoc($res);
  reset($row);
  return current($row);
}

function sql_insert()
{
  global $conn;
  global $_POST;

  $sql = "insert into `clients` (`id`, `old_id`, `group_id`, `name`, `telephone1`, `telephone2`, `mobile`, `fax`, `email`, `address1`, `address2`, `city`, `state`, `zip`) values (" .sqlvalue(@$_POST["id"], false) .", " .sqlvalue(@$_POST["old_id"], false) .", " .sqlvalue(@$_POST["group_id"], false) .", " .sqlvalue(@$_POST["name"], true) .", " .sqlvalue(@$_POST["telephone1"], true) .", " .sqlvalue(@$_POST["telephone2"], true) .", " .sqlvalue(@$_POST["mobile"], true) .", " .sqlvalue(@$_POST["fax"], true) .", " .sqlvalue(@$_POST["email"], true) .", " .sqlvalue(@$_POST["address1"], true) .", " .sqlvalue(@$_POST["address2"], true) .", " .sqlvalue(@$_POST["city"], true) .", " .sqlvalue(@$_POST["state"], true) .", " .sqlvalue(@$_POST["zip"], true) .")";
  mysqli_query($link, $sql, $conn) or die(mysqli_error($link));
}

function sql_update()
{
  global $conn;
  global $_POST;

  $sql = "update `clients` set `id`=" .sqlvalue(@$_POST["id"], false) .", `old_id`=" .sqlvalue(@$_POST["old_id"], false) .", `group_id`=" .sqlvalue(@$_POST["group_id"], false) .", `name`=" .sqlvalue(@$_POST["name"], true) .", `telephone1`=" .sqlvalue(@$_POST["telephone1"], true) .", `telephone2`=" .sqlvalue(@$_POST["telephone2"], true) .", `mobile`=" .sqlvalue(@$_POST["mobile"], true) .", `fax`=" .sqlvalue(@$_POST["fax"], true) .", `email`=" .sqlvalue(@$_POST["email"], true) .", `address1`=" .sqlvalue(@$_POST["address1"], true) .", `address2`=" .sqlvalue(@$_POST["address2"], true) .", `city`=" .sqlvalue(@$_POST["city"], true) .", `state`=" .sqlvalue(@$_POST["state"], true) .", `zip`=" .sqlvalue(@$_POST["zip"], true) ." where " ."(`id`=" .sqlvalue(@$_POST["xid"], false) .")";
  mysqli_query($link, $sql, $conn) or die(mysqli_error($link));
}

function sql_delete()
{
  global $conn;
  global $_POST;

  $sql = "delete from `clients` where " ."(`id`=" .sqlvalue(@$_POST["xid"], false) .")";
  mysqli_query($link, $sql, $conn) or die(mysqli_error($link));
} ?>
