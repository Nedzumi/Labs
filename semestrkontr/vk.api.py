import requests
import json


VKAPI_URL = 'https://api.vk.com/method/'


def request(method, params):
    res = requests.get(VKAPI_URL + method, params=params)
    j = json.loads(res.text)
    if 'error' in j:
        print('Error ({}):'.format(j['error']['error_code']))
        print('\t' + j['error']['error_msg'])
        return None
    return j
