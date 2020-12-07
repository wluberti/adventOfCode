#! /usr/bin/env python3
# not working(shoudl be 131469), does work for part 2 though ;-)

import re
from pprint import pprint as pp

with open('input.txt', "r") as f:
    data = f.read().split('\n')
    data.sort()

class guard():
    def __init__(self):
        self.sleep = None
        self.wake = None
        self.guardId = None
        self.sollution = {}

    def guardChange(self, tekst):
        m = re.match(r".*#(?P<guardId>\d+).*$", tekst)

        try:
            self.guardId = m.group('guardId')
            self.sleep = None
        except:
            pass

    def markAsleep(self, minute, tekst):
        if tekst == 'falls asleep':
            self.sleep = int(minute)

    def markAwake(self, minute, tekst):
        if tekst == 'wakes up':
            self.wake = int(minute)

    def calculate(self):
        if self.guardId != None and self.sleep != None and self.wake !=None:
            try:
                minutes = self.sollution[self.guardId]
            except:
                minutes = [0] * 60

            for i in range(self.sleep, self.wake):
                minutes[i] += 1

            self.sollution[self.guardId] = minutes

            # Reset all the things (except GuardId)
            self.sleep = None
            self.wake = None

x = guard()

for line in data:
    m = re.match(r"\[(?P<jaar>\d+)-(?P<maand>\d+)-(?P<dag>\d+) (?P<uur>\d+):(?P<minuut>\d+)\] (?P<tekst>.*$)", line).groupdict()

    x.guardChange(m['tekst'])
    x.markAsleep(m['minuut'], m['tekst'])
    x.markAwake(m['minuut'], m['tekst'])

    x.calculate()

worstGuard = []

for guard in x.sollution:
    tmp = {
        'guard': guard,
        'times': max(x.sollution[guard]),
        'index': x.sollution[guard].index(max(x.sollution[guard])),
        'multiplied': x.sollution[guard].index(max(x.sollution[guard])) * int(guard),
        'sum': sum(x.sollution[guard]),
    }
    worstGuard.append(tmp)

most = max(guard['times'] for guard in worstGuard)

pp(worstGuard)
print(most)