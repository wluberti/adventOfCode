#! /usr/bin/env python3
# from https://alfredgamulo.com/2018/12/04/advent-of-code-day-4.html
import re

lines = []
for line in open("input.txt"):
    lines.append(line.strip())
lines.sort()

pattern = re.compile('\[\d{4}-\d{2}-\d{2}\s(?P<hour>\d{2}?):(?P<minute>\d{2}?)\]\s(?P<msg>.*?)$')
id = None
sleeps = {}
for line in lines:
    s = pattern.match(line)
    msg = str(s.group('msg'))
    if 'Guard' in msg:
        id = str(msg.split(' ')[1].split('#')[1])
    if 'falls' in msg:
        start = int(s.group('minute'))
    if 'wakes' in msg:
        end = int(s.group('minute'))
        if id not in sleeps:
            sleeps[id] = []
        sleeps[id].extend(list(range(start,end)))

# part 1
g_longest = 0
g_id = None
g_minute = 0
for g,v in sleeps.items():
    if len(v) > g_longest:
        g_longest = len(v)
        g_id = g
        g_minute = max(set(v), key=v.count)

print(int(g_id)*int(g_minute))