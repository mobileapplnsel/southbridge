<?php
$page =  $this->uri->segment(2);
?>
<aside class="left-sidebar" data-sidebarbg="skin5">
	<!-- Sidebar scroll-->
	<div class="scroll-sidebar">
		<!-- Sidebar navigation-->
		<nav class="sidebar-nav">
			<ul id="sidebarnav" class="p-t-30">
				<li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_admin_url(); ?>dashboard" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>

				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">User Management</span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'add-user' || $page == 'user-list'|| $page == 'add-user-category'|| $page == 'add-user-category') ? 'in' : ''; ?>">
						<li class="sidebar-item <?php echo ($page == 'add-user-category') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>add-user-category" class="sidebar-link <?php echo ($page == 'add-user-category') ? 'active' : ''; ?>">
								<i class="fa fa-plus text-green"></i>
								<span class="hide-menu"> Add User Category</span>
							</a>
						</li>
						<li class="sidebar-item <?php echo ($page == 'user-category-management') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>user-category-management" class="sidebar-link <?php echo ($page == 'user-category-management') ? 'active' : ''; ?>">
								<i class="fa fa-list text-red"></i>
								<span class="hide-menu">User Category List</span>
							</a>
						</li>

						<li class="sidebar-item <?php echo ($page == 'add-user') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>add-user" class="sidebar-link <?php echo ($page == 'add-user') ? 'active' : ''; ?>">
								<i class="fa fa-plus text-green"></i>
								<span class="hide-menu"> Add User</span>
							</a>
						</li>
						<li class="sidebar-item <?php echo ($page == 'users') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>users" class="sidebar-link <?php echo ($page == 'users') ? 'active' : ''; ?>">
								<i class="fa fa-list text-red"></i>
								<span class="hide-menu">User List</span>
							</a>
						</li>
					</ul>
				</li>

				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Servise Category</span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'add-service-category' || $page == 'service-category-list') ? 'in' : ''; ?>">
						<li class="sidebar-item <?php echo ($page == 'add-service-category') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>add-service-category" class="sidebar-link <?php echo ($page == 'add-service-category') ? 'active' : ''; ?>">
								<i class="fa fa-plus text-green"></i>
								<span class="hide-menu"> Add Servise Category</span>
							</a>
						</li>
						<li class="sidebar-item <?php echo ($page == 'service-category-management') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>service-category-management" class="sidebar-link <?php echo ($page == 'service-category-management') ? 'active' : ''; ?>">
								<i class="fa fa-list text-red"></i>
								<span class="hide-menu">Service Category List</span>
							</a>
						</li>
					</ul>	
				</li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Servise Management</span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'add-service' || $page == 'service-list') ? 'in' : ''; ?>">
						<li class="sidebar-item <?php echo ($page == 'add-service') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>add-service" class="sidebar-link <?php echo ($page == 'add-service') ? 'active' : ''; ?>">
								<i class="fa fa-plus text-green"></i>
								<span class="hide-menu"> Add Servise</span>
							</a>
						</li>
						<li class="sidebar-item <?php echo ($page == 'service-list') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>service-list" class="sidebar-link <?php echo ($page == 'service-list') ? 'active' : ''; ?>">
								<i class="fa fa-list text-red"></i>
								<span class="hide-menu">Service List</span>
							</a>
						</li>
					</ul>	
				</li>
				<li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Subscription Management</span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'add-package' || $page == 'package-list') ? 'in' : ''; ?>">
						<li class="sidebar-item <?php echo ($page == 'add-package') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>add-package" class="sidebar-link <?php echo ($page == 'add-package') ? 'active' : ''; ?>">
								<i class="fa fa-plus text-green"></i>
								<span class="hide-menu"> Add Package</span>
							</a>
						</li>
						<li class="sidebar-item <?php echo ($page == 'package-list') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>package-list" class="sidebar-link <?php echo ($page == 'package-list') ? 'active' : ''; ?>">
								<i class="fa fa-list text-red"></i>
								<span class="hide-menu">Package List</span>
							</a>
						</li>
						<li class="sidebar-item <?php echo ($page == 'subcribed-users-list') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>subcribed-users-list" class="sidebar-link <?php echo ($page == 'subcribed-users-list') ? 'active' : ''; ?>">
								<i class="fa fa-list text-red"></i>
								<span class="hide-menu">Subscribed Users List</span>
							</a>
						</li>
					</ul>	
				</li>
				<li class="sidebar-item"> 
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">Enquery Management</span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'enquery-list' || $page == 'enquery-details') ? 'in' : ''; ?>">
						<li class="sidebar-item <?php echo ($page == 'enquery-list') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>enquery-list" class="sidebar-link <?php echo ($page == 'enquery-list') ? 'active' : ''; ?>">
								<i class="fa fa-list text-red"></i>
								<span class="hide-menu">Enquery List</span>
							</a>
						</li>
					</ul>	
				</li>
				<li class="sidebar-item"> 
					<a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-receipt"></i><span class="hide-menu">CMS Management</span></a>
					<ul aria-expanded="false" class="collapse  first-level <?php echo ($page == 'cms' || $page == 'edit-cms') ? 'in' : ''; ?>">
						<!-- <li class="sidebar-item <?php echo ($page == 'add-cms') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>add-cms" class="sidebar-link <?php echo ($page == 'add-cms') ? 'active' : ''; ?>">
								<i class="fa fa-plus text-green"></i>
								<span class="hide-menu"> Add CMS</span>
							</a>
						</li> -->
						<li class="sidebar-item <?php echo ($page == 'cms') ? 'active' : ''; ?>">
							<a href="<?php echo base_admin_url(); ?>cms" class="sidebar-link <?php echo ($page == 'cms') ? 'active' : ''; ?>">
								<i class="fa fa-list text-red"></i>
								<span class="hide-menu">CMS</span>
							</a>
						</li>
					</ul>	
				</li>
			</ul>
		</nav>
	</div>
</aside>