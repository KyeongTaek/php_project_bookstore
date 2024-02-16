<header style="background-color:cyan;">
  <nav>
    <ul style="display: inline; list-style-type: none;">
      <li style="display: inline;">
        <a href="index.php">
          <img src="images/logo.png" width="30%" height="30%" alt="LOGO IS MISSING...">
        </a>
      </li>
      
      <?php
        if(!isset($_SESSION['uid'])) { // not logged
          echo '<li style="display: inline;"><a href="templates/signupFrame.html">sign up</a></li>';
          echo '<li style="display: inline;"><a href="templates/loginFrame.html">sign in</a></li>';
        }
        else { // logged
          echo '<li style="display: inline;">  ['.$_SESSION['uid'].']  </li>';
          echo '<li style="display: inline;"><a href="templates/tryLogout.php">log out</a></li>';
        }
      ?>
      <li style="display: inline;"><a href="templates/myInfo.html">myinfo</a></li>
      <li style="display: inline;"><a href="templates/orderList.html">orderList</a></li>
      <li style="display: inline;"><a href="templates/readingStatus.html">readingStatus</a></li>
    </ul>
  </nav>
</header>