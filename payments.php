<?php include 'db_connect.php' ?>


		<div class="card">
			<div class="card-header">
				<large class="card-title">
					<b>Payment List</b>
					<button class="btn btn-primary btn-sm btn-block col-md-2 float-right" type="button" id="new_payments"><i class="fa fa-plus"></i> New Payment</button>
				</large>
				
			</div>
			<div class="card-body">
				<table class="table table-bordered" style="width:100%" id="loan-list">
					<colgroup>
						<col width="10%">
				
						<col width="25%">
						<col width="20%">
						<col width="5%">
						<col width="5%">
						<col width="5%">
						<col width="5%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th class="text-center">#</th>
							
							<th class="text-center">Payee</th>
							<th class="text-center">Amount</th>
							<th class="text-center">Penalty</th>
							<th class="text-center">Processing Fee</th>
							<th class="text-center">Notarial Fee</th>
							<th class="text-center">Gross Receipt Fee</th>
							<th class="text-center">Insurance Fee </th>
							<th class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							
							$i=1;
							
							$qry = $conn->query("SELECT p.*,l.ref_no,concat(b.lastname,', ',b.firstname,' ',b.middlename)as name, b.contact_no, b.address from payments p inner join loan_list l on l.id = p.loan_id inner join borrowers b on b.id = l.borrower_id  order by p.id asc");
							while($row = $qry->fetch_assoc()):
								

						 ?>
						 <tr>
						 	
						 	<td class="text-center"><?php echo $i++ ?></td>
						 
						 	<td>
						 		<?php echo $row['payee'] ?>
						 		
						 	</td>
						 	<td>
						 		<?php echo number_format($row['amount'],2) ?>
						 		
						 	</td>
						 	<td class="text-center">
						 		<?php echo number_format($row['penalty_amount'],2) ?>
						 	</td>
						 	<td class="text-center">
						 		<?php echo number_format($row['pfee'],2) ?>
						 	</td>
						 	<td class="text-center">
						 		<?php echo number_format($row['nfee'],2) ?>
						 	</td>
						 	<td class="text-center">
						 		<?php echo number_format($row['grfee'],2) ?>
						 	</td>
						 	<td class="text-center">
						 		<?php echo number_format($row['insfee'],2) ?>
						 	</td>

						 	<td class="text-center">
						 			<button class="btn btn-outline-primary btn-sm edit_payment" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></button>
						 			<button class="btn btn-outline-danger btn-sm delete_payment" type="button" data-id="<?php echo $row['id'] ?>"><i class="fa fa-trash"></i></button>
						 	</td>

						 </tr>

						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>


<style>
	td p {
		margin:unset;
	}
	td img {
	    width: 8vw;
	    height: 12vh;
	}
	td{
		vertical-align: middle !important;
	}
</style>	
<script>
	$('#loan-list').dataTable()
	$('#new_payments').click(function(){
		uni_modal("New Payment","manage_payment.php",'modal-lg')
	})
	$('.edit_payment').click(function(){
		uni_modal("Edit Payement","manage_payment.php?id="+$(this).attr('data-id'),'modal-lg')
	})
	$('.delete_payment').click(function(){
		_conf("Are you sure to delete this data?","delete_payment",[$(this).attr('data-id')])
	})
function delete_payment($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_payment',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					$.toast({
		            heading: 'Welcome to ATM Loan System',
		            text: 'Data Successfully Deleted!',
		            position: 'top-right',
		            loaderBg:'#ff6849',
		            icon: 'info',
		            hideAfter: 3000, 
		            stack: 6
		          });
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>