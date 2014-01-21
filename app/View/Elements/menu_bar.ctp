<?php
	echo $this->Html->css('layout/flip_menu');
	
	echo $this->Html->script('menu_flip/jquery.menuFlip');
	echo $this->Html->script('layout/menu_bar');
?>

<ul id="flip_nav">
	<li><?php
		echo $this->Html->link('World Most Popular', '/statistics/world_most_popular', array());
	?></li>
	<li><?php
		echo $this->Html->link('Search Videos', '/statistics/search_videos', array());
	?></li>
</ul>