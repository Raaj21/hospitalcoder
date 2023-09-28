    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
    
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"><img src="images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            </div>
    
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="<?php echo "index.php";  ?>"> <i class="menu-icon fa fa-dashboard"></i>Home</a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>User</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="<?php echo "users-list.php";  ?>">Users List</a></li>
                            <li><i class="fa fa-users"></i><a href="<?php echo "create-user.php";  ?>">Create New User</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Projects</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-table"></i><a href="<?php echo "projects-list.php";  ?>">Projects List</a></li>
                            <li><i class="fa fa-plus-square"></i><a href="<?php echo "create-project.php";  ?>">Create Project</a></li>
                            <li><i class="fa fa-list-alt"></i><a href="<?php echo "sub-projects-list.php";  ?>">Sub-Projects List</a></li>
                            <li><i class="fa fa-plus-square"></i><a href="<?php echo "create-sub-project.php";  ?>">Create Sub-Project</a></li>
                            <li><i class="fa fa-link"></i><a href="<?php echo "create-client-id-user.php";  ?>">User-Client Id</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->