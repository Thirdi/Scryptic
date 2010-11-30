<?php
class AccountManager
{
  public function disableAccount($account_id)
  {
    $this->changeAccountStatus($account_id, 0);
  }

  public function enableAccount($account_id)
  {
    $this->changeAccountStatus($account_id, 1);
  }

  private function changeAccountStatus($account_id, $new_status)
  {
    $logger = sfContext::getInstance()->getLogger();
    $logger->info('Changing account status to '.$new_status.' for account id='.$account_id);

    $conn = null;
    try
    {
      $conn = Propel::getConnection(AccountPeer::DATABASE_NAME);

      // set account status to disable and set sf guard user to inactive
      $account = AccountPeer::retrieveByPk($account_id);
      $account->setStatus(0);
      $account->setUpdatedAt('NOW');
      $account->save($conn);

      $profiles = sfGuardUserProfilePeer::findByAccountId($account_id);
      foreach ($profiles as $profile)
      {
        $guard_user = $profile->getsfGuardUser();
        $guard_user->setIsActive(0);
        $guard_user->save($conn);
      }

      $conn->commit();
    }
    catch (Exception $e)
    {
      if ($conn != null)
      {
        $conn->rollback();
      }
      throw $e;
    }
  }
}
?>
