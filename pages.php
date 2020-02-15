<?php
$query="select * from transaction where user_id='$user_id'";
$result=mysqli_query($con,$query);
//counting the total records
$total_posts=mysqli_num_rows($result);
//using ceil function to devide
$total_pages=ceil($total_posts/$per_page);
//going to first page
echo" <center>
<div id=''>
<a href='finance.php?page=1'>First Page</a>";
for($i=1;$i<$total_pages;$i++)
{
echo"<a href='finance.php?page=$i'>$i</a>";
}
//going to first page
echo"<a href='finance.php?page=$total_pages'>Last Page</a>
</center>
</div>"; 

?>
