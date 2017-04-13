from pprint import pprint
from random import randint
import requests
import re

import vkapi


_posts_count = None


def test():
    get_random_mem('mem1001')


def get_random_mem(domain):
    try:
        count = get_posts_count(domain)
    except Exception as ex:
        return None, ''

    image_data = None
    text = ''
    while not image_data:
        rnd_offset = randint(0, count - 1)
        print('Random offset:', rnd_offset)

        image_url, text, res = get_post_content(rnd_offset, domain)
        if not image_url or not text:
            pprint(res)

        if image_url:
            image_data = download_image(image_url)
        if image_data:
            print('Image size: {} kbytes'.format(len(image_data) / 1024))

        print()

    return image_data, text


def download_image(url):
    r = requests.get(url, stream=True)
    data = b''
    if r.status_code == 200:
        for chunk in r.iter_content(1024):
            data += chunk
    return data


def get_post_content(post_offset, domain):
    res = vkapi.request('wall.get', {'domain': domain, 'count': 1, 'offset': post_offset})

    try:
        image = res['response'][1]['attachment']['photo']['src_big']
    except:
        image = None

    try:
        text = res['response'][1]['text']
        text = re.sub('(\<br\>)+', '\n', text)
    except:
        text = None

    print('Image URL:', image)
    print('Text:', text)
    return image, text, res


def get_posts_count(domain):
    global _posts_count
    if _posts_count:
        return _posts_count

    res = vkapi.request('wall.get', {'domain': domain, 'count': 1, 'offset': 0})
    _posts_count = res['response'][0]
    # pprint(res)
    print('Total posts count:', _posts_count)
    return _posts_count


if __name__ == '__main__':
    test()
