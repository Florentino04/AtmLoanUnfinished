<?php 
if(isset($_POST['sub']))
{
    $search=$_POST['searchMember'];
$q=mysqli_query($conn,"select * from member where first_name='$search' or last_name='$search'");
}
else
{
   $q=mysqli_query($conn,"select * from member"); 
}
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red'>No any Group Member exists !!!</h2>";}
else
{
?>
<div class="col-12">
    		<div class="card mt-5">
                <h2 class="card-header">All Groups Members</h2>
		        <div class="card-body">
		        	<form class="needs-validation row"  action="index.php?page=report_member" novalidate method="post">
		<input type="text" placeholder="Search Member" name="searchMember" class="col-md-4 form-control"required />
		<input type="submit" value="Search Member" name="sub" class="col-md-2 btn btn-success" />
	</form>
<!--  Author Name: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me at mayuri.infospace@gmail.com  -->
</div>
</div>
</div>
<div class="col-12">
            <div class="card mt-5">
                <div class="card-body table-responsive">
	
	<table id="dom-jqry" class="table table-striped text-center">
    <tr class="active">
        <th>Sr.No</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Group</th>
        <th>Date</th>
    </tr>
        <?php 


$i=1;
while($row=mysqli_fetch_assoc($q))
{

echo "<tr>";
echo "<td>".$i."</td>";
echo "<td>".$row['first_name']."</td>";
echo "<td>".$row['last_name']."</td>";
echo "<td>".$row['gender']."</td>";

$q1=mysqli_query($conn,"select * from groups where group_id='".$row['group_id']."'");
$r1=mysqli_fetch_assoc($q1);

echo "<td>".$r1['group_name']."</td>";
echo "<td>".$row['join_date']."</td>";

?>
<?php 

echo "</tr>";
$i++;
}
        ?>
</table>
<!--  Author Name: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me at mayuri.infospace@gmail.com  -->
<?php }?>