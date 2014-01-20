<?php //debug($video); ?>
<div id="thumbnail">
	<a href="http://www.youtube.com/watch?v=<?php echo $video['id']; ?>" target="_blank">
		<img width="120" height="90" src="<?php echo $video['thumbnail']; ?>" />
	</a>
</div>
<div id="infoContainer">
	<a href="http://www.youtube.com/watch?v=<?php echo $video['id']; ?>" target="_blank">
		<span class="itemTitle"><?php echo $video['title']; ?> </span><br />
	</a>
	<div class="itemCategory"><?php echo $video['category']; ?></div>

	<div id="itemFirstCol">
		<div class="itemStatistic">
			<div id="viewContainer">
				<div class="itemImage viewIcon"></div><span><?php echo $video['viewCount']; ?></span>
			</div>
		</div>

		<div class="itemStatistic">
			<div id="commentContainer">
				<div class="itemImage commentIcon"></div><span><?php echo $video['commentCount']; ?></span>
			</div>
		</div>
	</div>

	<div id="itemSecondCol">
		<div class="itemStatistic">
			<div id="ratingContainer">
				<div class="itemImage ratingIcon"></div><span><?php echo $video['ratingCount']; ?></span>
			</div>
		</div>

		<div class="itemStatistic">
			<div id="likeContainer">
				<div class="itemImage likeIcon"></div><span><?php echo $video['likeCount']; ?></span>
			</div>
		</div>
	</div>

</div>
<div class="clearfix"></div>