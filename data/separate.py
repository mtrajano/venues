#data scraped from jambase was all together, this separates by artist, venue, event
import json

f = open("all.json", "r")

all_objects = json.loads(f.read())
artists = []
venues = []
events = []

for unknown in all_objects:
	if "zipcode" in unknown:
		venues.append(unknown)
	elif "number_fans" in unknown:
		artists.append(unknown)
	elif "artist" in unknown:
		events.append(unknown)
	else:
		print unknown

with open('artists.json', 'w') as outfile:
	json.dump(artists, outfile)

with open('venues.json', 'w') as outfile:
	json.dump(venues, outfile)

with open('events.json', 'w') as outfile:
	json.dump(events, outfile)