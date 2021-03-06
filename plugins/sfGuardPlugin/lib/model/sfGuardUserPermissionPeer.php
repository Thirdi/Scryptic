<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: sfGuardUserPermissionPeer.php 7633 2008-02-27 17:54:50Z fabien $
 */
class sfGuardUserPermissionPeer extends PluginsfGuardUserPermissionPeer
{
  public static function getByUserId($user_id)
  {
    $c = new Criteria();
    $c->add(sfGuardUserPermissionPeer::USER_ID, $user_id);
    $c->addJoin(sfGuardUserPermissionPeer::PERMISSION_ID, sfGuardPermissionPeer::ID);
    return sfGuardUserPermissionPeer::doSelect($c);
  }
}
