<?php

// Load main includes
require_once('config.inc.php');

$totalInstalls = DB::queryFirstField('SELECT count(1) FROM zrom_stats');
$totalInstallsLast24h = DB::queryFirstField('SELECT count(1) FROM zrom_stats WHERE date_register > date_sub(now(), INTERVAL 24 HOUR)');
$totalUpdatesLast24h = DB::queryFirstField('SELECT count(1) FROM zrom_stats WHERE date_last_checking > date_sub(now(), INTERVAL 24 HOUR)');

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ROM Statistics</title>
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/css/bootstrap-combined.min.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding: 40px;
      }
      table tbody tr td:first-child {
        width: 150px;
      }
    </style>
  </head>
  <body>
    <div class="container">
      <!-- Page Header -->
      <div class="row">
        <div class="span12"><div class="page-header"><h1>ROM Statistics</h1></div></div>
      </div>

      <!-- Content -->
      <div class="row">
  <div class="span12">
    <p> 
      Devices that have not checked in within the last 90 days are periodically removed from the database.  Statistics may be delayed by up to one minute.
    </p>
  </div>
</div>

<div class="row">
  <div class="span12">
    <h2>Total Installs</h2>
    <table class="table table-striped table-bordered table-condensed">
      <thead>
        <tr><th>Type</th><th>Total</th></tr>
      </thead>
      <tbody>
        <tr><td>Total Installs</td><td><?=$totalInstalls?></td></tr>
        <tr><td>Installed last 24 Hours</td><td><?=$totalInstallsLast24h?></td></tr>
        <tr><td>Updated last 24 Hours</td><td><?=$totalUpdatesLast24h?></td></tr>
      </tbody>
    </table>
  </div>
</div>

<div class="row">
  <div class="span6">
    <h2>Installs by ROM</h2>
    <table class="table table-striped table-bordered table-condensed">
      <thead>
        <tr><th>ROM</th><th>Total</th></tr>
      </thead>
      <tbody>
      <?
	  $romList = DB::query('SELECT rom_name, rom_version, COUNT( 1 ) as rom_tot FROM  zrom_stats GROUP BY rom_name, rom_version ORDER BY 2 DESC LIMIT 0 , 50');

      foreach ($romList as $rom) {
      ?>
        <tr><td><?=$rom['rom_name'] . " " . $rom['rom_version'] ?></td><td><?=$rom['rom_tot']?></td></tr>
      <? } ?>
      </tbody>
    </table>
  </div>
  <div class="span6">
    <h2>Installs by Device</h2>
    <table class="table table-striped table-bordered table-condensed">
      <thead>
        <tr><th>Device</th><th>Total</th></tr>
      </thead>
      <tbody>
      <?
	  $romList = DB::query('SELECT device_name, COUNT( 1 ) as rom_tot FROM  zrom_stats GROUP BY device_name ORDER BY 2 DESC LIMIT 0 , 50');

      foreach ($romList as $rom) {
      ?>
        <tr><td><?=$rom['device_name']?></td><td><?=$rom['rom_tot']?></td></tr>
      <? } ?>
      </tbody>
    </table>
  </div>
</div>
    </div>
	<script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js"></script>
  </body>
</html>