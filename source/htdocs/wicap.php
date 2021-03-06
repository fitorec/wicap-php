<?php
/**
 * wicap.php
 *
 * Copyright (c) 2005 Caleb Phillips <cphillips@smallwhitecube.com>
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *
 * purpose: main script for the web side of wicap-php
 *
 * includes: config.php, disclaim.php, success.php, disagree.php
 * 
 * author: Caleb Phillips
 * version: 2005.06.09
 * 
 * another author: Hermes Ojeda Ruiz
 * version: 2012.05.18 
 */
	include_once('config.php');
	include_once('top.php');

?>
<div id="content"> 
<?php	
	if(isset($_POST['agree'])){
		// write to the leasefile (a named pipe)
		$fh = fopen(LEASEFILE,"w");
		$ip = $_SERVER['REMOTE_ADDR'];
	        fwrite($fh,"$ip\n");
		fclose($fh);	
		// success - this should be customized
?>
 <div id="title"><?php echo TITLE; ?></div>
 <hr>
<?php
		include_once('success.php');
	}else if(isset($_POST['disagree'])){
        	include_once('disagree.php');
	}else{
?>
 <div id="title"><?php echo TITLE; ?></div>
 <hr />
<p><?php 
$ipaddr = $_SERVER['REMOTE_ADDR']; 
echo $ipaddr;
 ?></p>
 <div id="disclaim">
  <?php include_once('disclaim.php'); ?>
  <form METHOD="POST" action="wicap.php">
   <input type="hidden" name="agree" value="1">
   <input type="submit" value="ACCEPT">
  </form>
  <form METHOD="POST" action="wicap.php">
   <input type="hidden" name="disagree" value="1">
   <input type="submit" value="I DO NOT ACCEPT">
  </form>
 </div> 
<?php } ?>
</div>
<?php
	include_once('bottom.php');
?>
