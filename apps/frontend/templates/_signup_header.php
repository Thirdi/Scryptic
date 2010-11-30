<div id="maincontainer">
  <div id="header">
    <h1 class="logo"><a href="/">Use Scryptic</a></h1>

	<?php // must update condition if route name has been changed for sign in
	  if (!$sf_user->isAuthenticated() && sfRouting::getInstance()->getCurrentRouteName() != 'sf_guard_signin') : ?>
      <?php include_partial('sfGuardAuth/signin') ?>
    <?php endif ?>

  </div>
  
  <div class="content">

