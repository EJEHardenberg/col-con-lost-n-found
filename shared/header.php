<!DOCTYPE html>
<html>
	<head>
		<title>Lost And Found <?php echo !empty($pageTitle) ? $pageTitle : ''; ?></title>
		<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-touch-fullscreen" content="yes">
        <meta charset="UTF-8" />
        <link rel="stylesheet" type="text/css" href="flakes/css/all.css">
	</head>

	<body>
		<div class="flakes-frame">
			<div class="flakes-navigation">
				<a href="/" class="logo">
					<h1>Lost &amp; Found</h1>
				</a>

				<ul>
					<li class="title">Tools</li>
					<li><a href="#">Search</a></li>
					<li><a href="/inventory.php">Inventory</a></li>
					<li><a href="/criteria.php">Manage Criteria</a></li>
					<?php 
					$events = EventService::getEvents();
					foreach ($events as $event): ?>
						<li><a href="/report-item.php?event_id=<?php echo $event->id ?>">Report Item (<?php echo htmlentities($event->name) ?>)</a></li>
					<?php endforeach; ?>
				</ul>

				<p class="foot">
					Utility provided by<br>
					<a href="http://ethanjoachimeldridge.info/">Ethan J. Eldridge</a> &bullet; <a href="https://github.com/EdgeCaseBerg/col-con-lost-n-found">source code</a>
				</p>
			</div>

			<div class="flakes-content">


				<div class="flakes-mobile-top-bar">
					<a href="" class="logo-wrap">
						<h1>Lost &amp; Found</h1>
					</a>

					<a href="/" class="navigation-expand-target">
						<img src="/flakes/img/site-wide/navigation-expand-target.png" height="26px">
					</a>
				</div>
