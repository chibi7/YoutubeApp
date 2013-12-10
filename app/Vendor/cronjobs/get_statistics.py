from ConfigParser import SafeConfigParser, ConfigParser
import requests
import json
import redis

class Cron:
    def __init__(self, config_path):
        self._parse_config(config_path)
        self.time_ranges = ["today", "this_week", "this_month", "all_time"]
        self._get_redis_connection()
        self._get_most_popular_videos()

    def _parse_config(self, config_path):
        config = ConfigParser()
        config.read(config_path)
        kargs_config = {
            'COUNTRIES': {},
            'REDIS': {},
        }
        for config_section, config_params in kargs_config.iteritems():
            options = config.options(config_section)
            for option in options:
                try:
                    kargs_config[config_section][option] = config.get(config_section, option).replace('"','')
                except ConfigParser.NoSectionError:
                    print "Something is wrong with section: {0} and option: {1}".format(config_section,
                                                                                        option)
        self.countries = kargs_config['COUNTRIES']
        self.redis = kargs_config['REDIS']

    def _get_redis_connection(self):
        try:
            self.redis_connection = redis.StrictRedis(host=self.redis["host"], port=int(self.redis["port"]), db=int(self.redis["most_popular"]))
            self.redis_connection.set(1, 'bb')
        except Exception as e:
            print "Problem with REDIS connection: {0}".format(e)

    def _get_most_popular_videos(self):
        for country, country_shortcut in self.countries.iteritems():
            for time_range in self.time_ranges:
                # print "most popular"
                # print country_shortcut
                r = requests.get("http://gdata.youtube.com/feeds/api/standardfeeds/{0}/most_popular?v=2&alt=jsonc&max-results=20&time={1}".format(country_shortcut, time_range))
                data = self._get_data(json.loads(r.text))
                self.redis_connection.set("{0}_small_{1}".format(country_shortcut, time_range), json.dumps(data[:3]))
                self.redis_connection.set("{0}_big_{1}".format(country_shortcut, time_range),  json.dumps(data))
                # break;

    def _get_data(self, data):
        default_value = "No data"
        result = []
        try:
            data['data']['items']
        except KeyError:
            return [default_value, ]
        for item in data['data']['items']:
            item_result = {}
            item_result['id'] = item['id']
            item_result['uploaded'] = item['uploaded']
            item_result['uploader'] = item['uploader']
            item_result['category'] = item['category']
            item_result['title'] = item['title']
            item_result['thumbnail'] = item['thumbnail']['sqDefault']
            item_result['rating'] = item.get('rating', default_value)
            item_result['likeCount'] = item.get('likeCount', default_value)
            item_result['ratingCount'] = item.get('ratingCount', default_value)
            item_result['viewCount'] = item.get('viewCount', default_value)
            item_result['commentCount'] = item.get('commentCount', default_value)
            result.append(item_result)
        return result


if __name__ == "__main__":
    cron = Cron("./config.ini")