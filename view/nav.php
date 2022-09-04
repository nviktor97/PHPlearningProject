<?php

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    echo "
        <nav id = 'nav'>
        <ul>
        <li><a href='http://localhost/works/sec/index.php'>Home</a></li>
        <li><a href='http://localhost/works/sec/view/companies.php'>Companies</a></li>
        <li><a href='http://localhost/works/sec/view/joblist.php'>All Jobs</a></li>
        <li><a href='http://localhost/works/sec/view/register.php'>Register</a></li>
        <li><a href='http://localhost/works/sec/view/login.php'>Login</a></li>
        </ul>
        </nav>";
  
}

else
{

    echo "
        <nav id = 'nav'>
        <ul>
        <li><a href='http://localhost/works/sec/index.php'>Home</a></li>
        <li><a href='http://localhost/works/sec/view/form.php'>Form</a></li>
        <li><a href='http://localhost/works/sec/view/submits.php'>Submits</a></li>
        <li><a href='http://localhost/works/sec/view/companies.php'>Companies</a></li>
        <li><a href='http://localhost/works/sec/view/joblist.php'>All Jobs</a></li>
        <li><a href='http://localhost/works/sec/view/userjob.php'>Your jobs</a></li>
        <li><a href='http://localhost/works/sec/view/logout.php'>Logout</a></li>
        </ul>
        </nav>";


}


?>