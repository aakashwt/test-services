<aside id="sidebar">
    <!--| MAIN MENU |-->
    <ul class="side-menu">
        <li class="<?php if(isset($parent) && $parent == 'dashboard') echo 'active' ;?>">
            <a href="<?php echo base_url(); ?>admin/dashboard">
                <i class="zmdi glyphicon glyphicon-align-justify"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="<?php if(isset($parent) && $parent == 'password') echo 'active' ;?>">
            <a href="<?php echo base_url(); ?>admin/changepassword">
                <i class="zmdi glyphicon glyphicon-edit"></i>
                <span>Change Password</span>
            </a>
        </li>
        <li class="<?php if(isset($parent) && $parent == 'categories') echo 'active' ;?>">
            <a href="<?php echo base_url(); ?>admin/categories">
                <i class="zmdi glyphicon glyphicon-edit"></i>
                <span>Categories</span>
            </a>
        </li>
    </ul>
</aside>