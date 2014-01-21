<?php
	echo $this->Html->css('statistics/get_search_result');

	echo $this->Html->script('statistics/get_search_result');
	echo $this->Html->script('jquery.tinycarousel.min');
?>

<?php

if($videoList === null) {
	debug("BRAK");
	return;
}
?>

<div id="searchResultContainer">
	<div id="slider-code">
	    <a class="buttons prev" href="#"></a>
	    <div class="viewport">
	        <ul class="overview">
	        <?php foreach($videoList as $key => $video): ?>
				<li><?php echo $this->element("video", $video) ?></li>
			<?php endforeach; ?>
	        </ul>
	    </div>
	    <a class="buttons next" href="#"></a>
	</div>
</div>