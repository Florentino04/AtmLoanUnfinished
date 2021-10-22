<?php 
extract($_POST);
if(isset($save))
{

mysqli_query($conn,"update loan set group_id='$group',loan_come_from='$source',loan_amount='$amount',payment_schedule='$payment',due_date='$due' where loan_id='".$_GET['loan_id']."'");
		
$err="<font color='blue'>Loan records updated</font>";
		
}

$sql=mysqli_query($conn,"select * from loan where loan_id='".$_GET['loan_id']."'");
$res=mysqli_fetch_array($sql);
//print_r($res);
?>
<div class="col-12">
<div class="card mt-5">
    <h2 class="card-header">Update Allotted Loan Records</h2>
    <div class="card-body">
    	<form class="needs-validation" novalidate method="post">
	
	<div class="form-group row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"><?php echo @$err;?></div>
	</div>
	
	<div class="form-group row">
		<div class="col-sm-4">Select Group</div>
		<div class="col-sm-5">
		<select name="group" class="form-control" required>
			<option value="">Select Group</option>
			<?php 
$q1=mysqli_query($conn,"select * from groups");
while($r1=mysqli_fetch_assoc($q1))
{
?>
<option  
value="<?php echo  $r1['group_id'];?>" <?php if($res['group_id']==$r1['group_id']){echo "selected";} ?>><?php echo $r1['group_name']; ?></option>
<?php 
}
			?>
		</select>
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-sm-4">Loan Source</div>
		<div class="col-sm-5">
		<select name="source" class="form-control" required>
			<option value="">Select Loan COming Source</option>
			<option <?php if($res['loan_come_from']=="Government"){echo "selected";} ?>>Government</option>
			<option <?php if($res['loan_come_from']=="Council"){echo "selected";} ?>>Council</option>
		</select>
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-sm-4">Loan Amount</div>
		<div class="col-sm-5">
		<input type="number" value="<?php echo $res['loan_amount']; ?>" name="amount" class="form-control" required/></div>
	</div>
	
	<div class="form-group row">
		<div class="col-sm-4">Loan Intereset</div>
		<div class="col-sm-5">
		<input type="text"  name="intereset" value="10%" readonly="true" class="form-control" required/></div>
	</div>
	
	
	<div class="form-group row">
		<div class="col-sm-4">Payment Schedule</div>
		<div class="col-sm-5">
		<input type="date" value="<?php echo $res['payment_schedule']; ?>" name="payment" class="form-control"  required/>
	
		</div>
	</div>
	
	<div class="form-group row">
		<div class="col-sm-4">Payment Due Date</div>
		<div class="col-sm-5">
		<input type="date" value="<?php echo $res['due_date']; ?>" name="due" class="form-control" required/>
	
		</div>
	</div>
	
	
	<div class="form-group row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
		
		
<input type="submit" value="Update Loan" name="save" class="btn btn-success"/>
		<input type="reset" class="btn btn-success"/>
		</div>
	</div>
</form>
<!--  Author Name: Mayuri K. 
 for any PHP, Codeignitor or Laravel work contact me at mayuri.infospace@gmail.com  -->	
</div>
</div>
</div>