<?php include 'db_connect.php' ?>
<?php 
//extract($_POST);
if(isset($id)){
	$qry = $conn->query("SELECT * FROM payments where id=".$_POST['id']);
	foreach($qry->fetch_array() as $k => $val){
		$$k = $val;
	}
}
$loan = $conn->query("SELECT l.*,concat(b.lastname,', ',b.firstname,' ',b.middlename)as name, b.contact_no, b.address from loan_list l inner join borrowers b on b.id = l.borrower_id where l.id = ".$_POST['loan_id']);
foreach($loan->fetch_array() as $k => $v){
	$meta[$k] = $v;
}
$payers = $meta['amount'];
$type_arr = $conn->query("SELECT * FROM loan_types where id = '".$meta['loan_type_id']."' ")->fetch_array();

$plan_arr = $conn->query("SELECT *,concat(months,' month/s [ ',interest_percentage,'%, ',penalty_rate,' ]') as plan FROM loan_plan where id  = '".$meta['plan_id']."' ")->fetch_array();

$monthly = ($meta['amount'] + ($meta['amount'] * ($plan_arr['interest_percentage']/100))) / $plan_arr['months']/2;
$penalty = $monthly * ($plan_arr['penalty_rate']/100);
$payments = $conn->query("SELECT * from payments where loan_id =".$_POST['loan_id']);
$pays = $conn->query("SELECT *,sum(amount) as netpay from payments where loan_id =".$_POST['loan_id']);
$np = $pays->fetch_array();
$paid = $payments->num_rows;
$amount_paid = $np['netpay'];
$total_paid = $payers - $amount_paid;
$offset = $paid > 0 ? " offset $paid ": "";
	$next = $conn->query("SELECT * FROM loan_schedules where loan_id = '".$_POST['loan_id']."'  order by date(date_due) asc limit 1 $offset ")->fetch_assoc()['date_due'];
$sum_paid = 0;
while($p = $payments->fetch_assoc()){
	$sum_paid += ($p['amount'] - $p['penalty_amount']);
} if($total_paid == 0){
	$conn->query("UPDATE loan_list set status = 3 where id = '".$_POST['loan_id']."' ");

}

?>
<div class="col-lg-12">
<hr>
<div class="row">
	<div class="col-md-5">
		<div class="form-group">
			<label for="">Payee</label>
			<input name="payee" class="form-control" required="" value="<?php echo isset($payee) ? $payee : (isset($meta['name']) ? $meta['name'] : '') ?>">
		</div>
	</div>
	
</div>
<hr>
<div class="row">
	<div class="col-md-5">
		<p><small>Remaining Balance:<b><?php echo number_format($total_paid,2) ?></b></small></p>
		<p><small>Monthly amount:<b><?php echo number_format($monthly,2) ?></b></small></p>
		<p><small>Penalty :<b><?php echo $add = (date('Ymd',strtotime($next)) < date("Ymd") ) ?  $penalty : 0; ?></b></small></p>
		<p><small>Payable Amount :<b><?php echo number_format($monthly + $add,2) ?></b></small></p>
	</div>
	<script type="text/javascript">
    function ShowHideDiv(chkPassport) {
        var dvPassport = document.getElementById("dvPassport");
        dvPassport.style.display = chkPassport.checked ? "block" : "none";
    }
</script>
	<div class="col-md-5">
		<div class="form-group">
			<label for=""><small>Amount</small></label>
			<input type="number" name="amount" step="any" min="" class="form-control text-right" required="" value="<?php echo isset($amount) ? $amount : '' ?>">
			<br>
			<input type="checkbox" class="check" id="flat-checkbox-1" data-checkbox="icheckbox_flat-red" id="chkPassport" onclick="ShowHideDiv(this)">
            <label for="flat-checkbox-1"><small>Others</small></label>
		<div id="dvPassport" style="display: none">
			<label for="flat-checkbox-1"><small>1% Processing Fee</small></label>
			<input name="pfee" step="any" min="" class="form-control text-right" required="" value="<?php echo isset($pfee) ? $pfee : '' ?>">
			<label for="flat-checkbox-1"><small>2% Gross Receipt Fee</small></label>
			<input name="grfee" step="any" min="" class="form-control text-right" required="" value="<?php echo isset($grfee) ? $grfee : '' ?>">
			<label for="flat-checkbox-1"><small>Notarial Fee</small></label>
			<input name="nfee" step="any" min="" class="form-control text-right" required="" value="<?php echo isset($nfee) ? $nfee : '' ?>">
			<label for="flat-checkbox-1"><small>Insurance Fee</small></label>
			<input name="insfee" step="any" min="" class="form-control text-right" required="" value="<?php echo isset($insfee) ? $insfee : '' ?>">
		</div>
			<input type="hidden" name="penalty_amount" value="<?php echo $add ?>">
			<input type="hidden" name="loan_id" value="<?php echo $_POST['loan_id'] ?>">
			<input type="hidden" name="overdue" value="<?php echo $add > 0 ? 1 : 0 ?>">
		</div>
	</div>
</div>
</div>