<?php
	echo $this->Html->css('statistics/world_most_popular');
	echo $this->Html->css('statistics/most_popular_popup');
	// echo $this->Html->css('jmap/jqvmap');
	echo $this->Html->css('jvector/jquery-jvectormap');
	echo $this->Html->css('qtip/jquery.qtip');

	echo $this->Html->script('qtip/jquery.qtip');
	// echo '<script type="text/javascript" rel="http://jvectormap.com/js/jquery-jvectormap-1.2.2.min.js"></script>';
	echo $this->Html->script('jvector/jquery-jvectormap');
	echo $this->Html->script('jvector/jquery-jvectormap-world-mill-en');
	// echo $this->Html->script('jmap/jquery.vmap');
	// echo $this->Html->script('jmap/jquery.vmap.world.js');
	// echo $this->Html->script('jmap/jquery.vmap.sampledata.js');
	echo $this->Html->script('jquery.tinycarousel.min');
	echo $this->Html->script('statistics/world_most_popular');
	echo $this->Html->script('statistics/most_popular_popup');
?>
<div id="map"></div>