<div class="video">
	
	<div class="title">
		<a href="http://www.youtube.com/watch?v=<?php echo $media_group['yt_videoid']; ?>" target="_blank">
			<?php 
			if(strlen($title) > 62):
				echo substr_replace($title, " . . .", 59);
			else:
				echo $title;
			endif;
			?>
		</a>
	</div>
	<div class="category"><?php echo $category; ?></div>

	<div class="clearfix"></div>

	<div class="author">
		<span>Author: <?php echo $author; ?></span> | 
		<span>Published: <?php echo date("Y-m-d H:i", strtotime($published)); ?></span>
	</div>

	<div class="clearfix"></div>
	<div class="leftSide">
		<a href="http://www.youtube.com/watch?v=<?php echo $media_group['yt_videoid']; ?>" target="_blank">
			<img width="480" height="360" src="<?php echo $media_group['media_thumbnail'][2]['url']; ?>" />
		</a>
		<div class="duration">Duration <?php echo $media_group['yt_duration']; ?> s</div>
	</div>

	<div class="rightSide">
		
		<div class="description"><?php echo $media_group['media_description']['$t']; ?></div>

		<div class="columnWrapper">
			<div class="leftColumn">

				<div class="likes item">
					<div class="likeIcon"></div><span><?php echo $yt_rating['numLikes']; ?></span>
					<div class="clearfix"></div>
				</div>

				<div class="viewCount item">
					<div class="viewCountIcon"></div><span><?php echo $yt_statistics['viewCount']; ?></span>
					<div class="clearfix"></div>
				</div>

				<div class="rating item">
					<div class="ratingIcon"></div><span><?php echo $gd_rating=="No data" ? "---" : $gd_rating; ?></span>
					<div class="clearfix"></div>
				</div>

				<div class="clearfix"></div>
			</div>

			<div class="rightColumn">

				<div class="unlikes item">
					<div class="dislikeIcon"></div><span><?php echo $yt_rating['numDislikes']; ?></span>
					<div class="clearfix"></div>
				</div>

				<div class="favoriteCount item">
					<div class="favoriteCountIcon"></div><span><?php echo $yt_statistics['favoriteCount']; ?></span>
					<div class="clearfix"></div>
				</div>

				<div class="comments item">
					<div class="commentsIcon"></div><span><?php echo $gd_comments['gd$feedLink']['countHint']; ?></span>
					<div class="clearfix"></div>
				</div>


				<div class="clearfix"></div>
			</div>

			<div class="clearfix"></div>
		</div>

	</div>

	<div class="clearfix"></div>

</div>