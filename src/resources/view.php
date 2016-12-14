<?php
/**
 * PHP library for handling exceptions and errors.
 * 
 * @category   JST
 * @package    ErrorHandler
 * @author     Josantonius - info@josantonius.com
 * @copyright  Copyright (c) 2016 JST PHP Framework
 * @license    https://opensource.org/licenses/MIT - The MIT License (MIT)
 * @version    1.0.0
 * @link       https://github.com/Josantonius/ErrorHandler
 * @since      Class available since 1.0.0 - Update: Nov 19, 2016 
 */
?>
<div class="jst-alert Default <?= static::$stack['type'] ?>">

	<span class="jst-head">

      <?= static::$stack['code'] ?> <?= strtoupper(static::$stack['type']) ?>
      <a href="https://stackoverflow.com/search?q=[php] <?= static::$stack['message'] ?>" rel="nofollow" class="stackoverflow-link" target="_blank">&#x2768&#x2753&#x2769</a>

	</span>

  <span class="jst-head jst-right">

    <?= static::$stack['mode'] ?> 

  </span>

	<span class="jst-message">

  		<br><br><?= static::$stack['message'] ?>
      <br>in <?= static::$stack['file'] ?>
  		on line <?= static::$stack['line'] ?> 
      <?= nl2br(static::$stack['trace']) ?>

	</span>

</div>