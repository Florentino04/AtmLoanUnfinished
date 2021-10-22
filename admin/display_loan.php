<?php 
$q=mysqli_query($conn,"select * from loan");
$rr=mysqli_num_rows($q);
if(!$rr)
{
//echo "<h2 style='color:red'>No any Loan Records exists !!!</h2>";
echo '<a title="Add New Loan Records" class="col-md-3 btn btn-primary" href="index.php?page=add_loan"><span class="fa fa-plus">
		</span> Allot New Loan ?</a>';
}
else
{
?>
<script>
	function Deleteloan(id)
	{
		if(confirm("You want to delete this Record ?"))
		{
		window.location.href="delete_loan_record.php?id="+id;
		}
	}
</script>
<!--  Author Name: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me at mayuri.infospace@gmail.com  -->
<div class="col-12">
    		<div class="card mt-5">
                <h2 class="card-header">All Loan Details</h2>
		        <div class="card-body">
		        	<form class="needs-validation row"  action="index.php?page=search_loan" novalidate method="post">
		<select name="seachLoan" class="form-control col-md-4" required>
			<option value="">Select Group</option>
			<?php 
$q1=mysqli_query($conn,"select * from groups");
while($r1=mysqli_fetch_assoc($q1))
{
echo "<option value='".$r1['group_id']."'>".$r1['group_name']."</option>";
}
			?>
		</select>
		<input type="submit" value="Search Loan" name="sub" class="col-md-2 btn btn-success" />
	</form>
<!--  Author Name: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me at mayuri.infospace@gmail.com  -->
</div>
</div>
</div>
<div class="col-12">
            <div class="card mt-5">
            	<div class="card-header row">
            	<a title="Add New Loan Records" class="col-md-1 btn btn-primary" href="index.php?page=add_loan"><span class="fa fa-plus">
		</span></a>
		&nbsp; &nbsp; 
		<a title="Print all Loan Records" class="col-md-1 btn btn-info" href="print_loan_record.php"><span class="fa fa-print">
		</span></a>
			</div>
			<table id="dom-jqry" class="table table-striped text-center">
	<tr class="active">
		<th>Sr.No</th>
		<th>Group Name</th>
		<th>Loan Source</th>
		<th>Amount</th>
		<th>Interest</th>
		<th>Payment Schedule</th>
		<th>Due Date</th>
		<th>Delete</th>
		<th>Update</th>
	</tr>
		<?php 


$i=1;
while($row=mysqli_fetch_assoc($q))
{

echo "<tr>";
echo "<td>".$i."</td>";


$q1=mysqli_query($conn,"select * from groups where group_id='".$row['group_id']."'");
$r1=mysqli_fetch_assoc($q1);

echo "<td>".$r1['group_name']."</td>";
echo "<td>".$row['loan_come_from']."</td>";
echo "<td>".$row['loan_amount']."</td>";
echo "<td>".$row['loan_interest']."</td>";
echo "<td>".$row['payment_schedule']."</td>";
echo "<td>".$row['due_date']."</td>";

?>

<td><a href="javascript:Deleteloan('<?php echo $row['loan_id']; ?>')" style='color:Red'><span class='fa fa-trash'></span></a></td>

<td><a href="index.php?page=update_loan_record&loan_id=<?php echo $row['loan_id']; ?>" style='color:green'><span class='fa fa-edit'></span></a></td>
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
	
<?php }?>