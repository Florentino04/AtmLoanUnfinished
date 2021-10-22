<?php 
$q=mysqli_query($conn,"select * from loan");
$rr=mysqli_num_rows($q);
if(!$rr)
{

echo '<a title="Add New Payment Records" class="col-md-4 btn btn-primary" href="index.php?page=add_payment_history"><span class="fa fa-plus"></span> Add New Payment Records</a>';
}
else
{
?>
<script>
	function Deleteloan(id)
	{
		if(confirm("You want to delete this Record ?"))
		{
		window.location.href="delete_payment_record.php?id="+id;
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
		<td colspan="6">
		
		
		
		<a title="Print all Loan Records" class="col-md-1 btn btn-info" href="print_loan_record.php"><span class="fa fa-print"></span></a>
		
		</td>
	</tr>
	<tr class="active">
		<th>Sr.No</th>
		<th>Group Name</th>
		<th>Emi Paid</th>
		<th>Payment Date</th>
	</tr>
		<?php
         error_reporting(1);
         $sql = "SELECT * FROM payment_history ";
            
         $retval = mysqli_query($conn, $sql);
         
         if(! $retval )
		  {
            die('Could not get data: ' . mysqli_error());
         }
         
         $inc=1;
		 while($row = mysqli_fetch_array($retval))
		  {
		  
           echo "<tr>";
echo "<td>".$inc."</td>";


$q1=mysqli_query($conn,"select * from groups where group_id='".$row['group_id']."'");
$r1=mysqli_fetch_assoc($q1);

echo "<td>".$r1['group_name']."</td>";

echo "<td>".$row['amount_paid']."</td>";
echo "<td>".$row['payment_date']."</td>";

        
         

?>
<?php 

echo "</tr>";
$inc++;
}
?>
		
</table>
<!--  Author Name: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me at mayuri.infospace@gmail.com  -->
<?php }?>