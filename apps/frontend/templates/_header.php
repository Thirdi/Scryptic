<div id="appcontainer">

<?php if ($sf_user->isAuthenticated()) : ?>

  <div id="appheader">
    <h1 class="logo"><a href="/">Use Scryptic</a></h1>

    <div id="myaccount">
      <?php echo link_to('<span>My Account</span>', '@myaccount', 'class=basebtn btn-myacct-sm') ?>
      <?php echo link_to('<span>Log Out</span>', '@sf_guard_signout', 'class=basebtn btn-logout-sm') ?>
    </div>
  </div>

  <div class="nav">
    <ul>
      <?php $current_route = sfRouting::getInstance()->getCurrentRouteName() ?>

      <li class="nav-print">
	    <?php echo link_to('<span>Print</span>', '@printpage', array('class'=>('printpage'==$current_route ? 'current': ''))) ?>
      </li>
      <li class="nav-config">
	    <?php echo link_to('<span>Configure</span>', '@configpage', array('class'=>('configpage'==$current_route ? 'current': ''))) ?>
      </li>

	  <?php if ($sf_user->hasCredential('administrator')) : ?>
      <li class="nav-users">
	    <?php echo link_to('<span>Users</span>', '@userspage', array('class'=>('userspage'==$current_route ? 'current': ''))) ?>
      </li>
      <?php endif ?>

      <li class="nav-history">
	    <?php echo link_to('<span>History</span>', '@printreport', array('class'=>('printreport'==$current_route ? 'current': ''))) ?>
      </li>
    </ul>
  </div>

<?php endif ?>

  <div class="appcontent">

