# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy


class Event(scrapy.Item):
    date = scrapy.Field()
    artist = scrapy.Field()
    venue = scrapy.Field()
    city = scrapy.Field()
    state = scrapy.Field()

class Artist(scrapy.Item):
    name = scrapy.Field()
    genre = scrapy.Field()
    jambase_id = scrapy.Field()
    number_fans = scrapy.Field()
    description = scrapy.Field()

class Venue(scrapy.Item):
    name = scrapy.Field()
    street = scrapy.Field()
    city = scrapy.Field()
    state = scrapy.Field()
    zipcode = scrapy.Field()
    jambase_id = scrapy.Field()
    description = scrapy.Field()
