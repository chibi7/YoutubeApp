<?php
	echo $this->Html->css('statistics/search_videos');
	echo $this->Html->css('easydropdown/easydropdown.flat');
	echo $this->Html->css('iostoggle/toggle_light');

	echo $this->Html->script('easydropdown/jquery.easydropdown.min');
	echo $this->Html->script('statistics/search_videos');
	echo $this->Html->script('iostoggle/toggle');
	echo $this->Html->script('power_ranger/powerRanger');
?>

<div id="searchOptionsContainer">

	<form method="POST" action="get_search_result">
		
		<div class="option">
			<!--keyword-->
			<div class="optionWrapper" style="width: 520px; margin-left: 30px;">
				<div class="elementWrapper" style="width: 500px;">
				<?php echo $this->element("search_text_field", array(
					'placeholder' => 'Keyword', 
					"id" => "searchKeyword",
					"name" => "q"
				)); ?>
				</div>
				<div class="help hint--right hint--info hint--rounded hint--width" data-hint="The keyword parameter specifies a search query term. YouTube will search all video metadata for videos matching the term. Video metadata includes titles, keywords, descriptions, authors' usernames, and categories.">?</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="option">
			<!--author-->
			<div class="optionWrapper" style="width: 520px; margin-left: 30px;">
				<div class="elementWrapper" style="width: 500px;">
				<?php echo $this->element("search_text_field", array(
					"0" => "---",
					'placeholder' => 'Author',
					 "id" => "searchAuthor",
					 "name" => "author"
				 )); ?>
				</div>
				<div class="help hint--right hint--info hint--rounded hint--width" data-hint="In a search request, the author parameter restricts the search to videos uploaded by a particular YouTube user.">?</div>
				<div class="clearfix"></div>
			</div>	
		</div>

		<div class="option">
			<!--category-->
			<div class="optionWrapper">
				<div class="optionLabel">Category</div>
				<div class="elementWrapper">
				<?php echo $this->element("easydropdown", array('options' => $categories, "name" => "category")); ?>
				</div>
				<div class="help hint--right hint--info hint--rounded hint--width" data-hint="In video search requests, it enables you to retrieve videos that are in a particular category or are tagged with a particular keyword or developer tag.">?</div>
				<div class="clearfix"></div>
			</div>	
		</div>

		<div class="option">
			<!--region-->
			<div class="optionWrapper">
				<div class="optionLabel">Region</div>
				<div class="elementWrapper">
				<?php echo $this->element("easydropdown", array('options' => $region, "name" => "region")); ?>
				</div>
				<div class="help hint--right hint--info hint--rounded hint--width" data-hint="The region parameter restricts a movie or show chart to only list content that is viewable in a specified region">?</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="option">
			<!--language-->
			<div class="optionWrapper">
				<div class="optionLabel">Language</div>
				<div class="elementWrapper">
				<?php echo $this->element("easydropdown", array('options' => $language, "name" => "lr")); ?>
				</div>
				<div class="help hint--right hint--info hint--rounded hint--width" data-hint="In a video search request, the language parameter restricts the search to videos that have a title, description or keywords in a specific language.">?</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="option">
			<!--time-->
			<div class="optionWrapper">
				<div class="optionLabel">Time</div>
				<div class="elementWrapper">
				<?php echo $this->element("easydropdown", array('options' => array(
					"0" => "---",
					"today" => "today",
					"this_week" => "this week",
					"this_month" => "this month",
					"all_time" => "all time"
				), "name" => "time")); ?>
				</div>
				<div class="help hint--right hint--info hint--rounded hint--width" data-hint="The time parameter is supported for search feeds, the most_popular standard video feed, and live event charts. Valid values for this parameter are today (1 day), this week (7 days), this month (1 month) and all time.">?</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="option">
			<!--duration-->
			<div class="optionWrapper">
				<div class="optionLabel">Duration</div>
				<div class="elementWrapper">
				<?php echo $this->element("easydropdown", array('options' => array(
					"0" => "---",
					"short" => "short",
					"medium" => "medium",
					"long" => "long"
				), "name" => "duration")); ?>
				</div>
				<div class="help hint--right hint--info hint--rounded hint--width" data-hint="The duration parameter lets you filter search results based on video length">?</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="option">
			<!--HD-->
			<div class="optionWrapper">
				<div class="optionLabel">HD</div>
				<div class="elementWrapper">
				<?php echo $this->element("switcher", array("name" => "hd")); ?>
				</div>
				<div class="help hint--right hint--info hint--rounded hint--width" data-hint="The hd parameter lets you restrict a search to only include HD videos, meaning videos that are available for playback in at least 720p. Higher resolutions, like 1080p, might be available for HD videos as well.">?</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="option">
			<!--3D-->
			<div class="optionWrapper">
				<div class="optionLabel">3D</div>
				<div class="elementWrapper">
				<?php echo $this->element("switcher", array("name" => "3d")); ?>
				</div>
				<div class="help hint--right hint--info hint--rounded hint--width" data-hint="The 3d parameter lets you restrict a search to only retrieve 3D videos.">?</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="option">
			<!--order by-->
			<div class="optionWrapper">
				<div class="optionLabel">Order by</div>
				<div class="elementWrapper">
				<?php echo $this->element("easydropdown", array('options' => array(
					"0" => "---",
					"relevance" => "relevance",
					"published" => "published",
					"viewCount" => "viewCount",
					"rating" => "rating"
				), "name" => "orderby")); ?>
				</div>
				<div class="help hint--right hint--info hint--rounded hint--width" data-hint="The order by parameter, which is supported for video feeds and playlist feeds, specifies the method that will be used to order entries.">?</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="option">
			<!--max_results-->
			<div class="optionWrapper">
				<div class="optionLabel" style="margin-top: -6px;">Max Results</div>
				<div class="elementWrapper">
				<?php echo $this->element("power_ranger", array(
				'name' => 'max-results', 
				'current' => 10,
				'min' => 1,
				'max' => 25
				)); ?>
				</div>
				<div class="help hint--right hint--info hint--rounded hint--width" data-hint="The max-results parameter specifies the maximum number of results that should be included in the result set.">?</div>
				<div class="clearfix"></div>
			</div>
		</div>

		<div class="option">
			<input style="margin-left: 50px;" type="submit" value="Search" id="bigbutton" />
		</div>

	</form>
	

</div>

