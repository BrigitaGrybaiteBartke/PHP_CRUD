<?php
// Function for active navigation link
    function active($currect_page){
        $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
        $url = end($url_array);  
        if($currect_page == $url){
           echo 'active';
        } 
}

?>
        <nav class="navbar navbar-expand-lg bg-light">
            <div class="container-fluid">
                <a class="navbar-brand <?php active("index.php")?>" href="index.php" style="font-weight: 600; color: grey;">CRUD</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?php active("projects.php")?>" href="projects.php">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php active("employees.php")?>" href="employees.php">Employees</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
