<?php if(!empty($result)) : ?>
<ul id="tabs">
	<?php $tabCounter = 1; ?>
	<?php foreach($result as $key => $video): ?>
    <li><a href="#" name="#tab<?php echo $tabCounter++; ?>"><?php echo str_replace("_", " ", $key); ?></a></li>  
	<?php endforeach; ?>
</ul>

<div id="popupContent">
	<?php $tabCounter = 1; ?>
	<?php foreach($result as $key => $videoList): ?>

<!--     <div id="tab<?//php echo $tabCounter++; ?>" >
		<?php //foreach($videoList as $video): ?>
		<?php //echo $video['title']; ?><br />
		<?php //endforeach; ?>
    </div> -->

	<div id="tab<?php echo $tabCounter; ?>" >
	    <div id="slider-code<?php echo $tabCounter++; ?>" class="slider-code">
		    <a class="buttons prev" href="#"></a>
		    <div class="viewport">
		        <ul class="overview">
		            <?php foreach($videoList as $video): ?>
					<li><?php echo $this->element('most_popular_item', array('video' => $video)); ?></li>
					<?php endforeach; ?>
		        </ul>
		    </div>
		    <a class="buttons next" href="#"></a>
		</div>
	</div>

    <?php endforeach; ?>
</div>
<?php else: return null; ?>
<?php endif; ?>