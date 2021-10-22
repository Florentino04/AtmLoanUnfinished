<?php 
$q=mysqli_query($conn,"select * from member");
$rr=mysqli_num_rows($q);
if(!$rr)
{
//echo "<h2 style='color:red'>No any Group Member exists !!!</h2>";
echo '<a href="index.php?page=add_group_member" class="col-md-2 btn btn-primary">Add New Member?</a>';}
else
{
?>
<script>
	function DeleteMember(id)
	{
		if(confirm("You want to delete this Member ?"))
		{
		window.location.href="delete_group_member.php?id="+id;
		}
	}
</script>
<!--  Author Name: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me at mayuri.infospace@gmail.com  -->
<div class="col-12">
    		<div class="card mt-5">
                <h2 class="card-header">All Groups Members</h2>
		        <div class="card-body">
		        	<form class="needs-validation row"  action="index.php?page=search_member" novalidate method="post">
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
            	<a href="index.php?page=add_group_member" class="col-md-2 btn btn-primary">Add New Member</a>
                <div class="card-body table-responsive">
	
	<table id="dom-jqry" class="table table-striped text-center">
    <tr class="active">
        <th>Sr.No</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Gender</th>
        <th>Group</th>
        <th>Date</th>
        <th>Delete</th>
        <th>Update</th>
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

<td><a href="javascript:DeleteMember('<?php echo $row['member_id']; ?>')" style='color:Red'><span class='fa fa-trash'></span></a></td>

<td><a href="index.php?page=update_group_member&member_id=<?php echo $row['member_id']; ?>" style='color:green'><span class='fa fa-edit'></span></a></td>
<?php 

echo "</tr>";
$i++;
}
        ?>
</table>
<!--  Author Name: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me at mayuri.infospace@gmail.com  -->
<?php }?>