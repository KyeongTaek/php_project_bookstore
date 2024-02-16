session_start();

if(!isset($_SESSION['logged'])) {
  $_SESSION['logged'] = 0;
}
$_SESSION['logged'] = $_SESSION['logged'] + 1;

echo '<script type="text/javascript">location = "../index.php";</script>';