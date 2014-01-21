<?php

class StatisticsController extends AppController {

	var $uses = array();

	public function world_most_popular() {
		
	}

	public function get_world_most_popular() {
		$this->layout = null;
		if($this->request->is('ajax')) {
			Configure::write('debug', 0);
			if(!empty($this->data)) {
				try {
					$this->loadModel('Statistic');
					$videos = $this->Statistic->getMostPopularVideos($this->data['country_code'], "small");
				} catch (Exception $e) {
					$videos = array();
				}
				$this->set('result', $videos);
			}
		}
		
	}

	public function search_videos() {
		$this->loadModel('Statistic');
		$this->set("categories", $this->Statistic->parseCategoryXml());
		$this->set("region", $this->Statistic->getRegion());
		$this->set("language", $this->Statistic->getLanguages());
	}

	public function get_search_result() {
		if(empty($this->data)) {
			return $this->redirect(
	            array('controller' => 'statistics', 'action' => 'search_videos')
	        );
		}
		$this->loadModel('Statistic');
		$videoList = $this->Statistic->getVideoData($this->data);
		$this->set("videoList", $videoList);
	}


}