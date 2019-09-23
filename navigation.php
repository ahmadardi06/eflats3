<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/<?= $BASEAPP;?>/index.php">
        <b>EFlats</b>
      </a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <div class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input id="txtSearching" type="text" class="form-control" placeholder="Search">
        </div>
        <button id="btnSearching" type="button" class="btn btn-default">Search</button>
      </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/<?= $BASEAPP;?>/index.php">Dashboard</a></li>
        <?php if(!isset($_SESSION['level'])) { ?>
          <li><a data-toggle="modal" data-target="#myFormRegistration" href="#">Register</a></li>
        <?php } ?>
        <?php if(isset($_SESSION['level'])) { ?>
          <li><a href="/<?= $BASEAPP;?>/myprofile.php">My Profile</a></li>
          <?php if($_SESSION['level'] == 'customer') { ?>
            <?php $get = $db->query("SELECT * FROM customer WHERE customer_id = '".$_SESSION['userId']."'")->fetch_assoc(); ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $get['username'];?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/<?= $BASEAPP;?>/myproperties.php">My Properties</a></li>
                <li><a href="/<?= $BASEAPP;?>/manproperties.php">Manage Ads</a></li>
                <li><a href="/<?= $BASEAPP;?>/myfavorites.php">Favorites</a></li>
                <li><a id="btnDeactiveAccount" href="#">Deactive</a></li>
                <li><a href="/<?= $BASEAPP;?>/logout.php">Logout</a></li>
              </ul>
            </li>
          <?php } else if ($_SESSION['level'] == 'admin') { ?>
            <?php $get = $db->query("SELECT * FROM admin WHERE admin_id = '".$_SESSION['userId']."'")->fetch_assoc(); ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $get['username'];?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="/<?= $BASEAPP;?>/myproperties.php">My Properties</a></li>
                <li><a href="/<?= $BASEAPP;?>/allcustomers.php">All Customers</a></li>
                <li><a href="/<?= $BASEAPP;?>/allproperties.php">All Properties</a></li>
                <li><a href="/<?= $BASEAPP;?>/logactivities.php">Logs Activity</a></li>
                <li><a href="/<?= $BASEAPP;?>/logout.php">Logout</a></li>
              </ul>
            </li>
          <?php } ?>
        <?php } ?>
        <?php if(!isset($_SESSION['level'])) { ?>
          <li><a data-toggle="modal" data-target="#myCustomerLogin" href="#">Customer Area</a></li>
          <li><a data-toggle="modal" data-target="#myAdminLogin" href="#">Admin Area</a></li>
        <?php } ?>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>