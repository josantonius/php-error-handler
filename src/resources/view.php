<?php
/**
 * PHP library for handling exceptions and errors.
 * 
 * @author     Josantonius - hello@josantonius.com
 * @copyright  Copyright (c) 2016 - 2017
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @link       https://github.com/Josantonius/PHP-ErrorHandler
 * @since      1.0.0
 */
?>
<div class="jst-alert Default <?= static::$stack['type'] ?>">

	<span class="jst-head">
      <?= static::$stack['code'] ?> <?= strtoupper(static::$stack['type']) ?>
      <a href="https://stackoverflow.com/search?q=[php] <?= static::$stack['message'] ?>" rel="nofollow" class="stackoverflow-link" target="_blank">&#9906;</a>
	</span>

   <span class="jst-head jst-right">
      <?= static::$stack['mode'] ?> 
   </span>

	<span class="jst-message"><br><br>
  	   <?= static::$stack['message'] ?>
   </span><br><br>
   
   <div class="jst-preview">
      <span class="jst-file">
         <?= static::$stack['file'] ?>
      </span><br>
      <code>
         <?= static::$stack['preview'] ?>
      </code>
   </div>
   <div class="jst-trace">
      <?= nl2br(static::$stack['trace']) ?>
   </div><br>

</div>