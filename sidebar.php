<nav class="bop-navbar navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand hidden-sm" href="/"><img src="/images/bop-logo-beta-full.png"></a>
    <a class="navbar-brand visible-sm" href="/"><img src="/images/bop2.png"></a>
  </div>
<?php if($session->logged_in){ ?>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
      <li><a href="/kop">Kit of Parts</a></li>
		  <li><a href="/teamlist.php">Teams</a></li>
		  <li><a href="/eventlist.php">Events</a></li>
    </ul>
    <!-- <form class="navbar-form navbar-left" role="search">
      	<div class="form-group">
          <input class="typeahead form-control" type="text" data-provide="typeahead" autocomplete="off" placeholder="Search for Parts">
      	</div>
    </form> -->
    <ul class="nav navbar-nav navbar-right">
      	<li class="dropdown">
        	<a href="" class="dropdown-toggle" data-toggle="dropdown"><?php echo $session->username ?> <b class="caret"></b></a>
        	<ul class="dropdown-menu">
          		<li><a href="/myteam">My Team</a></li>
            	<li><a href="/settings.php">Settings</a></li>
	    		<li class="divider"></li>
          		<li><a href="/logout.php">Logout</a></li>
        	</ul>
      	</li>
    </ul>
</div><!-- /.navbar-collapse -->
<?php }else{?>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
    <li><a href="/kop">Kit of Parts</a></li>
		<li><a href="/teams">Teams</a></li>
		<li><a href="/events">Events</a></li>
    </ul>
    <!-- <form class="navbar-form navbar-right" role="search">
      	<div class="form-group">
        	<input class="typeahead form-control" type="text" name="search" autocomplete="off" placeholder="Search for Parts">
      	</div>
    </form> -->
    <ul class="nav navbar-nav navbar-right">
    	<li><a href="/login.php">Login</a></li>
		  <!-- <li><a href="/register.php">Register</a></li> -->
    </ul>
</div>
<?php }?>
  
</nav>