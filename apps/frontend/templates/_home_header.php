<div id="maincontainer">
  <div id="header">
    <h1 class="logo"><a href="/">Use Scryptic</a></h1>

    <?php if ($sf_user->isAuthenticated()) : ?>
      <div id="myaccount" >
        <?php echo link_to('<span>My Account</span>', '@myaccount', 'class=basebtn btn-myacct-sm') ?>
        <?php echo link_to('<span>Log Out</span>', '@sf_guard_signout', 'class=basebtn btn-logout-sm') ?> 
      </div>
    <?php endif ?>

	<?php // must update condition if route name has been changed for sign in
	  if (!$sf_user->isAuthenticated() && sfRouting::getInstance()->getCurrentRouteName() != 'sf_guard_signin') : ?>
      <?php include_partial('sfGuardAuth/signin') ?>
    <?php endif ?>

  </div>
  
  <div class="content">
