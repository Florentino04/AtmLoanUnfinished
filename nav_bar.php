        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="assets/images/users/1.jpg" alt="user" /> </div>
                    <!-- User profile text-->
                    <div class="profile-text"> <a href="#" class="dropdown-toggle link u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"><?php echo $_SESSION['login_name'] ?> <span class="caret"></span></a>
                        <div class="dropdown-menu animated flipInY">
                            <a href="#" class="dropdown-item"><i class="ti-user"></i> My Profile</a>
                            <a href="#" class="dropdown-item"><i class="ti-wallet"></i> My Balance</a>
                            <a href="#" class="dropdown-item"><i class="ti-email"></i> Inbox</a>
                            <div class="dropdown-divider"></div> <a href="#" class="dropdown-item"><i class="ti-settings"></i> Account Setting</a>
                            <div class="dropdown-divider"></div> <a href="ajax.php?action=logout" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
 <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">PERSONAL</li>
                        <li>
                            <a href="index.php?page=home" class="waves-effect waves-dark"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
                            </li>
                            <li>
                <a href="index.php?page=loans" class="waves-effect waves-dark"><span class='icon-field'><i class="fa fa-file-invoice-dollar"></i></span> Loans</a>   
            </li>
            <li>
                <a href="index.php?page=payments" class="waves-effect waves-dark"><span class='icon-field'><i class="fa fa-money-bill"></i></span> Payments</a>
            </li><li>
                <a href="index.php?page=borrowers" class="waves-effect waves-dark"><span class='icon-field'><i class="fa fa-user-friends"></i></span> Borrowers</a>
            </li><li>
                <a href="index.php?page=plan" class="waves-effect waves-dark"><span class='icon-field'><i class="fa fa-list-alt"></i></span> Loan Plans</a> </li>
                <li>  
                <a href="index.php?page=loan_type" class="waves-effect waves-dark"><span class='icon-field'><i class="fa fa-th-list"></i></span> Loan Types</a>    
                </li>  <li>
                <?php if($_SESSION['login_type'] == 1): ?>
                <a href="index.php?page=users" class="waves-effect waves-dark"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
                
            <?php endif; ?>
                        </li>    
                        
                      
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
                <nav id="sidebar" class='mx-lt-5 bg-warning' >
        
        <div class="sidebar-list">

                
        </div>

</nav>
<script>
    $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>
