<?php foreach ($watermark_images as $wi) : ?>

    <div class="thumbnail">
      <div class="thumbimg">
        <?php 
          $width=""; 
          $height="";
          if ($wi->getWidth() > $wi->getHeight()) {
            $width='width="64"';
          } else {
            $height='height="64"';
          }
        ?>
        <img src="/printconfiguration/getWatermarkImage?name=<?php echo $wi->getImageName() ?>" border="1" <?php echo $width ?> <?php echo $height ?> />
      </div>
      <p>
        <input type="radio" value="<?php echo $wi->getId() ?>" onclick="watermarkImageClicked(this)"  <?php echo ($print_configuration->getWatermarkImageId() == $wi->getId() ? 'checked="checked"' : '') ?> name="watermark_image_id"> (<?php echo $wi->getWidth() ?>x<?php echo $wi->getHeight() ?>)<br/>
        <a class="button-delete" onclick="deleteWatermarkImage(<?php echo $wi->getId() ?>)">Delete</a>
      </p>
    </div>
<?php endforeach ?>

