  <div class="onecolpage">

    <?php if ($activated): ?>

      <h2>Congratulations!</h2>
      <p><strong>Registration is now complete.</strong></p>
      <p>Click <a href="/">here</a> to start using Scryptic!</p>

    <?php else: ?>

      <h2>Oops!</h2>
      <p><strong>An error has occurred while activating your account.</strong></p>
      <p>Code: <?php echo $code ?><br />Email: <?php echo $email ?></p>
      <p>If you have any questions, click <a href="/about">here</a> for contact information.</p>

    <?php endif; ?>

  </div>
