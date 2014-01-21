<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('layout/main');
		echo $this->Html->css('hint');

		echo $this->Html->script('jquery-2.0.3.min.js');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<header class="lightStrip">
			<?php echo $this->element('menu_bar'); ?>
		</header>

		<div id="content">
			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>

		<!-- <footer class="lightStrip">
		</footer> -->
	</div>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
