<?php

$get_id=$_GET['msg_id'];
$get_id="select * from messsage_reply where msg_id='$get_id' ORDER by 1 DESC ";
$run_id=mysqli_query($con,$get_id);
$row_posts=mysqli_fetch_array($run_posts);
while($row=mysqli_fetch_array($run_id))
{
$reply_id=$row['reply_id'];
$name=$row['sender_name'];
$date=$row['date'];
$com=$row['reply'];
echo"<div id='text'>
<h3>$name</h3><span><i>Said</i>
on $date</span>
<p>$com</p>
</div>";}

?>