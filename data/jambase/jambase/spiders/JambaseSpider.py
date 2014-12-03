import re
import scrapy
from scrapy.selector import Selector
from scrapy.contrib.spiders import CrawlSpider, Rule
from scrapy.contrib.linkextractors.sgml import SgmlLinkExtractor

from jambase.items import *

states = {
    "AL":"Alabama", "AK":"Alaska", "AZ":"Arizona", "AR":"Arkansas", "CA":"California", 
    "CO":"Colorado", "CT":"Connecticut", "DE":"Delaware", "FL":"Florida", "GA":"Georgia", 
    "HI":"Hawaii", "ID":"Idaho", "IL":"Illinois", "IN":"Indiana", "IA":"Iowa", "KS":"Kansas", 
    "KY":"Kentucky", "LA":"Louisiana", "ME":"Maine", "MD":"Maryland", "MA":"Massachusetts", 
    "MI":"Michigan", "MN":"Minnesota", "MS":"Mississippi", "MO":"Missouri", "MT":"Montana", 
    "NE":"Nebraska", "NV":"Nevada", "NH":"New Hampshire", "NJ":"New Jersey", "NM":"New Mexico", 
    "NY":"New York", "NC":"North Carolina", "ND":"North Dakota", "OH":"Ohio", "OK":"Oklahoma", 
    "OR":"Oregon", "PA":"Pennsylvania", "RI":"Rhode Island", "SC":"South Carolina", "SD":"South Dakota", 
    "TN":"Tennessee", "TX":"Texas", "UT":"Utah", "VT":"Vermont", "VA":"Virginia", "WA":"Washington", 
    "WV":"West Virginia", "WI":"Wisconsin", "WY":"Wyoming"
}

class JambaseSpider(CrawlSpider):
    name = "jambase"
    allowed_domains = ["www.jambase.com", ]
    start_urls = [
        "http://www.jambase.com/shows/Shows.aspx?State=%s&StartDate=11/26/2014&EndDate=1/26/2015&Rec=False&pagenum=1&pasi=100" % abrv for abrv in states
    ]

    rules = (
            Rule(SgmlLinkExtractor(allow=(r'shows/Shows\.aspx', ), restrict_xpaths=("//table[@class='showList']")), callback='parse_events'),
            
            Rule(SgmlLinkExtractor(allow=(r'Artists/\d+', ), restrict_xpaths=("//table[@class='showList']")), callback='parse_artist'),

            Rule(SgmlLinkExtractor(allow=(r'Venues/\d+', ), restrict_xpaths=("//table[@class='showList']")), callback='parse_venue'),
        )
            
    def parse_events(self, response):
        events = []

        for tr in response.xpath('//table[@class="showList"]//tr[@class="dateRow"]'):
            date = tr.xpath('td/a/text()').extract()[0]

            for row in tr.xpath('following-sibling::tr[@class = "dateRow" or @class = " "]'):
                if row.xpath('@id'):
                    break

                artist = row.xpath('td[@class="artistCol"]/a/text()').extract()[0]
                venue = row.xpath('td[@class="venueCol"]/a/text()').extract()[0]
                city = row.xpath('td[@class="locationCol"]/a/text()').extract()[0].strip()

                match = re.search('State=(\w{2})', response.url)
                state = match.group(1)

                event = Event(date=date, artist=artist, venue=venue, city=city, state=state)
                events.append(event)

        return events;
                
    def parse_artist(self, response):
        try:
            number_fans = response.css('#ctl00_ctl00_MainContent_ArtistContent_ctlArtistFans_txtFanCount::text').extract()[0]
        except IndexError:
            number_fans = 0
        
        name = response.css('.headerText::text').extract()[0]
        
        match = re.search("Artists/(\d+)/", response.url)
        jambase_id = match.group(1)

        return Artist(name=name, number_fans=number_fans, jambase_id=jambase_id)

    def parse_venue(self, response):
        name = response.css('.jb_VenueName::text').extract()[0]

        street = response.css('.streetAddress::text').extract()[0].strip()
        
        split_comma = response.css('.cityAddress::text').extract()[0].split(',')
        city = split_comma[0].strip()

        split_space = split_comma[1].split()
        state = split_space[0].strip()
        zipcode = split_space[1].strip()

        match = re.search("Venues/(\d+)/", response.url)
        jambase_id = match.group(1)

        return Venue(name=name, street=street, city=city, state=state, zipcode=zipcode, jambase_id=jambase_id)