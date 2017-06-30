<?php
$to ="m.hale@kingsfund.org.uk";
#$to = "m.hale@kingsfund.org.uk".", ";
$subject ="Press Selections - ";
$when= date("Y-m-d");
$subject .=$when;
$headers = "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "MIME-Version: 1.0\r\n";

$db = mysql_connect("localhost", "username", "password");
mysql_select_db("dbname",$db);
 
$result = mysql_query("select f.title, e.link, e.title, e.content, u.note, u.feed_id from ttrss_entries e, ttrss_feeds f, ttrss_user_entries u where u.marked=1 and u.owner_uid=2 and u.int_id = e.id and u.feed_id=f.id order by u.feed_id",$db);
$body = "<html><head>";
$body .= "<meta http-equiv='Content-type' content='text/html;charset=UTF-8'></head>";
$body .="<body style='font-size:11pt;font-family:Calibri';>";
$num=mysql_numrows($result);

$i=0;
$current_source=0;
$body .= "The latest selections...";
$body .= "<p>";
while ($i < $num) 						{
$row = mysql_fetch_row($result);


if ($row[5] <> $current_source)	{
$body .= "<hr>";
$body .= "<table><tr>";
$body .= "<td bgcolor=olive><strong>";
$body .= $row[8];
$body .= "</strong>";
$body .= "</td></tr></table>";
                                }
                                 
$current_source=$row[5];

if (($row[0] <> "") and ($row[0] <> "-")) 	{
$body .= "<p><strong>".$body .= $row[0]."</strong>: ";
					    	}
$body .="<em><a href='".$row[1]."'>".$row[2]."</a><br>";
$text = strip_tags($row[3]);
$text = preg_replace('/[^(\x20-\x7F)]*/','', $text);
$body .= $text;
$body .= "<br>";
                				}
if (($row[4] <> "") and ($row[4] <> "NULL")) 	{
$body .= $row[4];
$body .= "<br>";

						}
$i++;           
$body .= "</body></html>";                                  }

if ($num > 0) {
if (mail($to, $subject, $body, $headers)) {
   echo("<p>Message successfully sent!</p>");
  } else {
   echo("<p>Message delivery failed...</p>");
         }}
echo $body;

?>
