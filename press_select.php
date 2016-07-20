<?php
header("Cache-Control: no-cache");
header("Pragma: nocache");


$body1 = "<link rel='stylesheet' type='text/css' href='sylvester.css'>";

$when= date("Y-m-d");
$date_select = "%";
$date_select .= $when;
$date_select .= "%";
$check_title = "";

$db = mysql_connect("localhost", "gregarius", "password");
mysql_select_db("gregarius",$db);
if (isset($_POST['comment_itemid'])) {
$comment = $_POST['comments'];
$commentid = $_POST['comment_itemid'];
mysql_query("update item set comments = '".$comment."' where id ='".$commentid."'");
}
if (isset($_POST['itemid'])) {
$selection = $_POST['selection'];
$select = $_POST['select'];
$itemid = $_POST['itemid'];
$prev_id = $_POST['prev_id'];
if ($select=='0'){
mysql_query("update item set selections = replace(selections,'".$selection."','') where id ='".$itemid."'");
}
else {
mysql_query("update item set selections = concat(selections, '".$selection."') where id ='".$itemid."'");
}
$referer  = $_SERVER['HTTP_REFERER'];
$goto = "Location: $referer";
$goto .="#";
$goto .=$prev_id;
header($goto);
}
$when= date("Y-m-d");
$date_select = "%";
$date_select .= $when;
$date_select .= "%";
$body = "";
$check_title="";

#$result = mysql_query("SELECT i.title, i.description, i.pubdate, i.id, i.author, i.url, i.added, i.selections, c.title, i.comments FROM item i, channels c WHERE i.cid=c.id and (c.parent=16 or c.parent=24) and i.added like '".$date_select."' order by i.added desc",$db);

#$result = mysql_query("SELECT i.title, i.description, i.pubdate, i.id, i.author, i.url, i.added, i.selections, c.title, i.comments FROM item i, channels c WHERE i.cid=c.id and i.added like '".$date_select."' and DATE_SUB(CURDATE(), INTERVAL 5 DAY) <= i.pubdate and (c.id=294 or c.id=424 or c.id=425 or c.id=426 or c.id=427 or c.id=428 or c.id=1066 or c.id=1084 or c.id=1085 or c.id=1086 or c.id=1087 or c.id=1088 or c.id=1089 or c.id=1090 or ((c.parent=16 or c.parent=24 or c.id=294 or c.id=309 or c.id=386 or c.id=311 or c.id=312 or c.id=305 or c.id=323) and (i.description like '%King%s Fund%' or i.description like '%Health manager%' or i.description like '%Clinical commissioning%' or i.description like '%GP commissioning%' or i.description like '%GP consortia%' or i.description like '%NHS%' or i.description like '%Health Bill%' or i.description like '%Integrated health%' or i.description like '%Integrated health%' or i.description like '%social care%' or i.description like '%Integrated care%' or i.description like '%ospital%' or i.description like '%patient%' or i.description like '%Doctor%' or i.description like '%nurse%' or i.description like '%health%' or i.description like '%women in leadership%'))) order by i.title asc",$db);

$result = mysql_query("SELECT i.title, i.description, i.pubdate, i.id, i.author, i.url, i.added, i.selections, c.title, i.comments FROM item i, channels c WHERE i.cid=c.id and i.added like '".$date_select."' and DATE_SUB(CURDATE(), INTERVAL 5 DAY) <= i.pubdate and (c.id=294 or c.id=424 or c.id=425 or c.id=426 or c.id=427 or c.id=428 or c.id=1066 or c.id=1084 or c.id=1085 or c.id=1086 or c.id=1087 or c.id=1088 or c.id=1089 or c.id=1090 or ((c.parent=16 or c.parent=24 or c.id=294 or c.id=309 or c.id=386 or c.id=311 or c.id=312 or c.id=305 or c.id=323) and (i.description like '%King%s Fund%' or i.description like '%Health manager%' or i.description like '%Clinical commissioning%' or i.description like '%GP commissioning%' or i.description like '%GP consortia%' or i.description like '%NHS%' or i.description like '%Health Bill%' or i.description like '%Integrated health%' or i.description like '%Integrated health%' or i.description like '%social care%' or i.description like '%Integrated care%' or i.description like '%ospital%' or i.description like '%patient%' or i.description like '%Doctor%' or i.description like '%nurse%' or i.description like '%health%' or i.description like '%women in leadership%' or i.description like '%Health Foundation%' or i.description like '%Anita Charlesworth%' or i.description like '%Jennifer Dixon%' or i.description like '%Nuffield Trust%' or i.description like '%Nigel Edwards%' or i.description like '%Candace Imison%'))) order by i.title asc",$db);

$num=mysql_numrows($result);
ob_start("callback");
$i=0;
while ($i < $num) 						{

$body .= "<table><tr><td><a name='".$i."'></tr></table>";
$body .= "<hr>";
$body .= "<table class='sample'>";
$row = mysql_fetch_row($result);
if ($check_title != $row[0]){
if (preg_match("/P/",$row[7])) {
$body .= "<tr bgcolor=tomato>";
}
else {
$body .= "<tr>";
}
$body .= "<td>";
$body .= "Title:";
$body .= "<td>";
if (($row[0] <> "") and ($row[0] <> "-")) 	{
$title=$row[0];
$title=str_replace("King's Fund","<span style=background-color:red>King's Fund</span>",$title);
$title=str_replace('Chris Ham','<span style=background-color:red>Chris Ham</span>',$title);
$title=str_replace('Anna Dixon','<span style=background-color:red>Anna Dixon</span>',$title);
$title=str_replace('John Appleby','<span style=background-color:red>John Appleby</span>',$title);
$title=str_replace('Richard Humphries','<span style=background-color:red>Richard Humphries</span>',$title);
$title=str_replace('David Buck','<span style=background-color:red>David Buck</span>',$title);
$title=str_replace('Nick Goodwin','<span style=background-color:red>Nick Goodwin</span>',$title);
$title=str_replace('health manager','<span style=background-color:yellow>health manager</span>',$title);
$title=str_replace('clinical commissioning','<span style=background-color:yellow>clinical commissioning</span>',$title);
$title=str_replace('GP commissioning','<span style=background-color:yellow>GP commissioning</span>',$title);
$title=str_replace('GP consortia','<span style=background-color:yellow>GP consortia</span>',$title);
$title=str_replace('NHS reform','<span style=background-color:yellow>NHS reform</span>',$title);
$title=str_replace('Health Bill','<span style=background-color:yellow>Health Bill</span>',$title);
$title=str_replace('Integrated health','<span style=background-color:yellow>Integrated health</span>',$title);
$title=str_replace('NHS commissioning board','<span style=background-color:yellow>NHS commissioning board</span>',$title);
$title=str_replace('integrated health','<span style=background-color:yellow>integrated health</span>',$title);
$title=str_replace('social care','<span style=background-color:yellow>social care</span>',$title);
$title=str_replace('integrated care','<span style=background-color:yellow>integrated care</span>',$title);
$title=str_replace('hospital','<span style=background-color:yellow>hospital</span>',$title);
$title=str_replace('patient','<span style=background-color:yellow>patient</span>',$title);
$title=str_replace('doctor','<span style=background-color:yellow>doctor</span>',$title);
$title=str_replace('nurse','<span style=background-color:yellow>nurse</span>',$title);
$title=str_replace('health','<span style=background-color:yellow>health</span>',$title);
$body .= "<a href='";
$body .= $row[5];
$body .= "'>";
$body .= $title;
$body .= "</a>";
					    	}
if (($row[8] <> "") and ($row[8] <> "-")) 	{
$body .= " from ";
$body .= $row[8];
					    	}
$body .= "</tr>";
$body .= "<tr>";
$body .= "<td>";
$body .= "Date added:";
$body .= "<td>";
$body .= $row[2];
$body .= "</tr>";
$body .= "<tr>";
$body .= "<td>";
$body .= "Author:";
$body .= "<td>";
if (($row[4] <> "") and ($row[4] <> "-")) 	{
$body .= $row[4];
					    	}
$body .= "</tr>";

$body .= "<tr>";
$body .= "<td>";
$body .= "Description:";
$body .= "<td>";
if (($row[1] <> "") and ($row[1] <> "-")) 	{
$description = preg_replace("/<img[^>]+\>/i", " ", $row[1]);
$description=str_replace("King's Fund","<span style=background-color:red>King's Fund</span>",$description);
$description=str_replace('Chris Ham','<span style=background-color:red>Chris Ham</span>',$description);
$description=str_replace('Anna Dixon','<span style=background-color:red>Anna Dixon</span>',$description);
$description=str_replace('John Appleby','<span style=background-color:red>John Appleby</span>',$description);
$description=str_replace('Richard Humphries','<span style=background-color:red>Richard Humphries</span>',$description);
$description=str_replace('David Buck','<span style=background-color:red>David Buck</span>',$description);
$description=str_replace('Nick Goodwin','<span style=background-color:red>Nick Goodwin</span>',$description);
$description=str_replace('health manager','<span style=background-color:yellow>health manager</span>',$description);
$description=str_replace('clinical commissioning','<span style=background-color:yellow>clinical commissioning</span>',$description);
$description=str_replace('GP commissioning','<span style=background-color:yellow>GP commissioning</span>',$description);
$description=str_replace('GP consortia','<span style=background-color:yellow>GP consortia</span>',$description);
$description=str_replace('NHS reform','<span style=background-color:yellow>NHS reform</span>',$description);
$description=str_replace('Health Bill','<span style=background-color:yellow>Health Bill</span>',$description);
$description=str_replace('Integrated health','<span style=background-color:yellow>Integrated health</span>',$description);
$description=str_replace('NHS commissioning board','<span style=background-color:yellow>NHS commissioning board</span>',$description);
$description=str_replace('integrated health','<span style=background-color:yellow>integrated health</span>',$description);
$description=str_replace('social care','<span style=background-color:yellow>social care</span>',$description);
$description=str_replace('integrated care','<span style=background-color:yellow>integrated care</span>',$description);
$description=str_replace('hospital','<span style=background-color:yellow>hospital</span>',$description);
$description=str_replace('patient','<span style=background-color:yellow>patient</span>',$description);
$description=str_replace('doctor','<span style=background-color:yellow>doctor</span>',$description);
$description=str_replace('nurse','<span style=background-color:yellow>nurse</span>',$description);
$description=str_replace('health','<span style=background-color:yellow>health</span>',$description);
$body .= $description;						}				
$body .= "</tr>";
$body .= "</table>";
$body .= "<table>";
$body .= "<tr>";
$body .= "<td>";
if (preg_match("/P/",$row[7]))  {
$body .= "<form method='post' action='press_select.php'>";
$body .= "<input type='hidden' name='itemid' value='";
$body .= $row[3];
$body .= "'>";
$body .= "<input type='hidden' name='selection' value='P'>";
$body .= "<input type='hidden' name='select' value='0'>";
$prev_id = ($i-1);
$body .= "<input type='hidden' name='prev_id' value='".$prev_id."'>";
$body .= "<input type='submit' value='UnSelect for Press Team'>";
$body .= "</form>";
$body .= "</table>";
$body .= "<form method='post' id='".$row[3]."' action='press_select.php'>";
$body .= "<input type='hidden' name='comment_itemid' value='";
$body .= $row[3];
$body .= "'>";
$body .= "<input type='text' style='width:600px' name='comments' value='".$row[9]."'>";
$body .= "<input type='Submit' value='Submit'>";
$body .= "</form>";
}
else {
$body .= "<form method='post' action='press_select.php'>";
$body .= "<input type='hidden' name='itemid' value='";
$body .= $row[3];
$body .= "'>";
$body .= "<input type='hidden' name='selection' value='P'>";
$body .= "<input type='hidden' name='select' value='1'>";
$prev_id = ($i-1);
$body .= "<input type='hidden' name='prev_id' value='".$prev_id."'>";
$body .= "<input type='submit' value='Select for Press Team'>";
$body .= "</form>";
$body .= "</table>";
$body .="\n";
}
}
$check_title=$row[0];
$i++;
}
echo $body;

?>
