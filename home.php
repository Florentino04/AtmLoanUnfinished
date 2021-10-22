<?php include 'db_connect.php' ?>

			<div class="card">
				<div class="card-body">
						<h1>Admin Dashboard</h1>			
				</div>
				<hr>
				<div class="row ml-2 mr-2">
				<div class="col-md-3">
                        <div class="card bg-primary text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Payments Today</div>
                                        <div class="text-lg font-weight-bold">
                                        	<?php 
                                        	$payments = $conn->query("SELECT sum(amount) as total FROM payments where date(date_created) = '".date("Y-m-d")."'");
                                        	echo $payments->num_rows > 0 ? number_format($payments->fetch_array()['total'],2) : "0.00";
                                        	 ?>
                                        		
                                    	</div>
                                    </div>
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="index.php?page=payments">View Payments</a>
                                <div class="small text-white">
                                	<i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="col-md-3">
                        <div class="card bg-success text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Borrowers</div>
                                        <div class="text-lg font-weight-bold">
                                        	<?php 
                                        	$borrowers = $conn->query("SELECT * FROM borrowers");
                                        	echo $borrowers->num_rows > 0 ? $borrowers->num_rows : "0";
                                        	 ?>
                                        		
                                    	</div>
                                    </div>
                                    <i class="fa fa-user-friends"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="index.php?page=borrowers">View Borrowers</a>
                                <div class="small text-white">
                                	<i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                  <div class="col-md-3">
                        <div class="card bg-warning text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Active Loans</div>
                                        <div class="text-lg font-weight-bold">
                                        	<?php 
                                        	$loans = $conn->query("SELECT * FROM loan_list where status = 2");
                                        	echo $loans->num_rows > 0 ? $loans->num_rows : "0";
                                        	 ?>
                                        		
                                    	</div>
                                    </div>
                                    <i class="fa fa-user-friends"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="index.php?page=loans">View Loan List</a>
                                <div class="small text-white">
                                	<i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="card bg-info text-white mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="mr-3">
                                        <div class="text-white-75 small">Total Receivable</div>
                                        <div class="text-lg font-weight-bold">
                                        	<?php 
                                        	$payments = $conn->query("SELECT sum(amount - penalty_amount) as total FROM payments where date(date_created) = '".date("Y-m-d")."'");
                                        	$loans = $conn->query("SELECT sum(l.amount + (l.amount * (p.interest_percentage/100))) as total FROM loan_list l inner join loan_plan p on p.id = l.plan_id where l.status = 2");
                                        	$loans =  $loans->num_rows > 0 ? $loans->fetch_array()['total'] : "0";
                                        	$payments =  $payments->num_rows > 0 ? $payments->fetch_array()['total'] : "0";
                                        	echo number_format($loans - $payments,2);
                                        	 ?>
                                        		
                                    	</div>
                                    </div>
                                    <i class="fa fa-user-friends"></i>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="index.php?page=loans">View Loan List</a>
                                <div class="small text-white">
                                	<i class="fas fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>

				</div>
                            <div class="card-body">
                <table class="table table-bordered" style="width:100%" id="loan-list">
                  
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            
                            <th class="text-center">Borrower</th>
                            <th class="text-center">Loan Amount</th>
                            <th class="text-center">Paid Amount</th>
                           
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <?php
                        $i=1;
                            $type = $conn->query("SELECT * FROM loan_types where id in (SELECT loan_type_id from loan_list) ");
                            while($row=$type->fetch_assoc()){
                                $type_arr[$row['id']] = $row['type_name'];
                            }
                           
                            $qry = $conn->query("SELECT l.*,concat(b.lastname,', ',b.firstname,' ',b.middlename)as name, b.contact_no, b.address from loan_list l inner join borrowers b on b.id = l.borrower_id  order by id asc");
                            while($row = $qry->fetch_assoc()):
                               $payments = $conn->query("SELECT *,SUM(AMOUNT) AS MY_AMOUNT from payments where loan_id =".$row['id']);
                               while($p = $payments->fetch_assoc()){
                                    $sum_paid = $p['MY_AMOUNT'];
                                }
                         ?>
                    <tbody>
                  
                         <tr>
                            
                            <td class="text-center"></td>
                         
                            <td><?php echo ucwords($row['name']) ?></td>
                            <td><?php echo $amount =  $row['amount'] ?></td>
                            
                            <td><?php echo $sum_paid; ?></td>
                        
                            <td class="text-center">
                               <?php if ($sum_paid === $amount ){
                                echo "Completed";
                               }else{
                                $bal = $amount-$sum_paid;
                                echo $bal;
                               }?>
                            </td>
                            <td class="text-center">
                          
                            </td>
                       

                         </tr>
<?php endwhile; ?>
                       
                    </tbody>
                </table>
            </div>
			</div>
			


</div>
<script>
	
</script>