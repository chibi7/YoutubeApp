import requests
from ConfigParser import ConfigParser
from optparse import OptionParser
import json
import ast
import sys
import redis


class Cron():
    def __init__(self, config_path):
        self._options = self._parse_options()
        self._key = self._parse_config(config_path)
        #self._send_request()
        
    def _parse_config(self, config_path):
        config = ConfigParser()
        config.read(config_path)
        self._redis['host'] = config.get('REDIS', 'HOST')
        self._redis['port'] = config.get('REDIS', 'PORT')
        self._redis['db'] = config.get('REDIS', 'SEARCH_VIDEOS')
        return config.get('YOUTUBE_AUTH', 'key')

    def _parse_options(self):
        parser = OptionParser()
        parser.add_option("-c", "--con", dest="conditions",
                      help="add conditions in json format to search", metavar="CONDITIONS")
        parser.add_option("-k", "--key", dest="key",
                      help="save in redis with key", metavar="KEY")
        return parser.parse_args()[0]

    def _send_request(self):
        url = self._get_url("https://gdata.youtube.com/feeds/api/videos?alt=json")
        headers = {'GData-Version': '2', 'X-GData-Key': 'key={0}'.format(self._key)}
        r = requests.get(url, headers=headers)
        return self._get_data(json.loads(r.text))

    def _get_url(self, url):
        try:
            for keyword, option in ast.literal_eval(self._options.conditions).items():
                url += "&{0}={1}".format(keyword, option)
                return url
        except SyntaxError:
            print "Bad json format"
            sys.exit()

    def _get_data(self, data):
        default_value = "No data"
        try:
            data['feed']['entry']
        except KeyError:
            return [default_value, ]

        result = self._parse_response(data['feed']['entry'])
        if self._options.key:
            self._save_response(result)
        return result

    def _save_response(self, data):
        redis_connection = self._get_redis_connection()
        self.redis_connection.set("{0}".format(self._options.key), json.dumps(data))

    def _parse_response(self, data):
        result = []
        for item in data:
            result.append(item)
        return result

    def _get_redis_connection(self):
        try:
            return redis.StrictRedis(host=self._redis["host"],
                                     port=int(self._redis["port"]),
                                     db=int(self._redis["db"]))
        except Exception as e:
            print "Problem with REDIS connection: {0}".format(e)


if __name__ == "__main__":

    cron = Cron("../config.ini")