<?php
/// I didn't really want to make a homepage, but I wanted to make if for an example for dynamic titles
$Current_page = "Home Page";
require_once('./header.php');
if (!isset($_SESSION['username'])) {
    header("Location: log_in.php");
    exit();
}
?>

<div>This is a homepage you can make anything here</div>
<?php
require_once('./footer.php');