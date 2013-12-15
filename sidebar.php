<div class="clear"></div>
<div class="sidebar">
<div class="sidebar-wrapper">
	<div class="sidebar-logo" onclick="document.location.href='/index.php'"><img src="/images/bop-logo-beta-full.png" alt="BoP Logo" ></div>
<?php if($session->logged_in){ ?>
<ul id="<?php echo basename($_SERVER['PHP_SELF'],'.php') ?>">
	<li id="index"><a href="/index.php">Home</a></li>
	<li id="inventory"><a href="/inventory.php">Inventory</a></li>
	<li id="kop"><a href="/kop">Kit of Parts</a></li>
	<li id="teamlist"><a href="/teamlist.php">Teams</a></li>
	<li id="eventlist"><a href="/eventlist.php">Events</a></li>
</ul>
<ul id="sidebar-bottom">
	<li><a href="/myteam"><?php echo $session->username ?>  <span class="caret"></span></a>
            <ul>
                <li id="team"><a href="/myteam">My Team</a></li>
                <li id="settings"><a href="/settings.php">Settings</a></li>
                <li><a href="/logout.php">Logout</a></li>
            </ul>
    </li>
</ul>
<?php }else{?>
<ul>
	<li id="kop"><a href="/kop">Kit of Parts</a></li>
	<li id="teamlist"><a href="/teamlist.php">Teams</a></li>
	<li id="eventlist"><a href="/eventlist.php">Events</a></li>
</ul>
<ul id="sidebar-bottom">
	<li><a href="/login.php">Login</a></li>
	<li><a href="/register.php">Register</a></li>
</ul>
<?php }?>
</div>
</div>