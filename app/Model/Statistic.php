<?php

class Statistic extends AppModel {

	public $useTable = false;

	public function getMostPopularVideos($countryCode, $type) {
		if(empty($countryCode) || empty($type)) {
			throw new Exception("Empty data");
		}
		$countryCode = strtoupper($countryCode);
		if(!in_array($countryCode, $this->globalConfig['COUNTRIES']) || !in_array($type, $this->globalConfig['TIME_RANGES']['type'])) {
			throw new Exception("Malformed data");
		}

		App::import('Vendor', 'redis/RedisForWorldMostViewed');
		$redis = RedisForWorldMostViewed::Instance();
		foreach($this->globalConfig['TIME_RANGES']['time_shifts'] as $timeshift) {
			$movieList[$timeshift] = json_decode($redis->getMovieList($countryCode, $type, $timeshift), true);
		}

		return $movieList;
	}

}

?>