import requests
import json
from pprint import pprint
from random import randint
from datetime import date
from functools import reduce

import vkapi


def test():
    # friends = get_friends_with_nearest_birthday('26047', 5)
    friends = get_friends_with_nearest_birthday('2000000', 5)
    name = get_user_name('26047')


def get_user_name(user_id):
    res = vkapi.request('users.get', {'user_ids': user_id})
    pprint(res)

    try:
        name = '{} {}'.format(res['response'][0]['first_name'], res['response'][0]['last_name'])
    except:
        name = ''
    return name


def get_friends_with_nearest_birthday(user_id, count):
    friends = getfriends(user_id)
    if not friends:
        return

    friends = sort_by_bdate(friends)
    result = get_nearest_bdays(friends, count)

    pprint(result)
    return result


def get_nearest_bdays(peoples, count):
    l = []
    for p in peoples[:count]:
        name = '{} {}'.format(p['first_name'], p['last_name'])
        date_str = p['bdate'].strftime('%B %d')
        # date_str = p['bdate'].strftime('%Y-%m-%d')

        l.append({'bdate': date_str, 'name': name})
    return l


def sort_by_bdate(peoples):
    peoples_with_date = reduce(lambda res, people: res + [people] if 'bdate' in people else res, peoples, [])
    peoples_with_date.sort(key=lambda people: people['bdate'])
    return peoples_with_date


def getfriends(user_id):
    res = vkapi.request('friends.get', {'user_id': user_id, 'count': 1000, 'offset': 0, 'fields': 'bdate'})
    if not res:
        return None

    friends = res['response']
    parse_bdate(friends)

    # pprint(friends)
    # count = len(friends)

    return friends


def parse_bdate(peoples):
    for people in peoples:
        if 'bdate' in people:
            day, *other = [int(x) for x in people['bdate'].split('.')]
            month = other[0] if len(other) > 0 else None

            today = date.today()
            if month == 2 and day == 29:
                day = 28
            year = today.year if date(today.year, month, day) >= today else today.year + 1

            people['bdate'] = date(year, month, day)


if __name__ == '__main__':
    test()
