<?php 
$search=$_POST['searchGroup'];
$q=mysqli_query($conn,"select * from groups where group_name='$search' or 	registration_number='$search'");
$rr=mysqli_num_rows($q);
if(!$rr)
{
echo "<h2 style='color:red'>No any Records exists !!!</h2>";
}
else
{
?>
<script>
	function DeleteGrop(id)
	{
		if(confirm("You want to delete this Group ?"))
		{
		window.location.href="delete_group.php?id="+id;
		}
	}
</script>
<!--  Author Name: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me at mayuri.infospace@gmail.com  -->
<div class="col-12">
            <div class="card mt-5">
            	<div class="card-body table-responsive">
	
	<table class="table table-striped text-center">
	<tr>
		<td colspan="16"><a href="index.php?page=display_group">Go Back to Group Page</a></td>
	</tr>
	<tr class="active">
		<th>Sr.No</th>
		<th>Group Name</th>
		<th>Region</th>
		<th>district</th>
		<th>division</th>
		<th>ward</th>
		<th>village</th>
		<th>Reg No</th><th>Activity</th>
		<th>Category</th><th>Total Member</th>
		<th>Leader</th><th>loan</th>
		<th>Capital</th>
		<th>Delete</th>
		
	</tr>
		<?php 


$i=1;
while($row=mysqli_fetch_assoc($q))
{

echo "<tr>";
echo "<td>".$i."</td>";
echo "<td>".$row['group_name']."</td>";
echo "<td>".$row['region']."</td>";
echo "<td>".$row['district']."</td>";
echo "<td>".$row['division']."</td>";
echo "<td>".$row['ward']."</td>";
echo "<td>".$row['village']."</td>";
echo "<td>".$row['registration_number']."</td>";
echo "<td>".$row['group_activity']."</td>";
echo "<td>".$row['group_category']."</td>";
echo "<td>".$row['group_total_members']."</td>";
echo "<td>".$row['group_leader']."</td>";
echo "<td>".$row['loan_information']."</td>";
echo "<td>".$row['group_capital']."</td>";
?>

<td><a href="javascript:DeleteGrop('<?php echo $row['group_id']; ?>')" style='color:Red'><span class='fa fa-trash'></span></a></td>



<?php 
echo "</tr>";
$i++;
}
		?>
		
</table>
<!--  Author Name: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me at mayuri.infospace@gmail.com  -->
</div>
</div>
</div>
<?php }?>