<?php
$button = @$_POST ['submit'];
$search = @$_POST ['search']; 

if(!$button)
echo "Enter Job No";
else
{
if(strlen($search)<=0)
echo "Search term too short";
else{
echo "You searched for Job No: <b>$search</b> <hr size='1'></br>";
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "123";
$mysql_database = "transportation";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password)
or die("Opps some thing went wrong");
mysql_select_db($mysql_database, $bd) or die("Opps some thing went wrong");

$search_exploded = explode (" ", $search);

foreach($search_exploded as $search_each)
{
@$x++;
if($x==1)
@$construct .="jobno LIKE '%$search_each%'";
else
$construct .="AND jobno LIKE '%$search_each%'";

}

$construct ="SELECT * FROM formvalues WHERE $construct";
$run = mysql_query($construct);

$foundnum = mysql_num_rows($run);

if ($foundnum==0)
echo "Sorry, there are no matching result for <b>$search</b>.</br></br>1. 
Try more general words.Try different words with similar
 meaning</br>2. Please check your spelling";
 else
{
//echo "$foundnum results found !<p>";

while($runrows = mysql_fetch_assoc($run))
{

$item = $runrows ['item_name'];
$weight = $runrows ['weight'];
$sendfrom = $runrows ['sendfrom'];
$sendto = $runrows ['sendto'];
$reqdate = $runrows ['request_date'];
$lastdate = $runrows ['last_date'];
echo " <b> Item Name = $item<br>Weight = $weight <br>Send From = $sendfrom <br>Send To = $sendto <br>Request Date= $reqdate <br>
Last Date = $lastdate <br><hr>";

}
}

}
}

?>
<form action='search_cha.php' method='POST'>
<input type='text' size='30' name='search'>
<input type='submit' name='submit' value='Search by Job No ' >
</form>