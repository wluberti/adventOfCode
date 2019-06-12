#! /usr/bin/env python3

import re

with open('input.txt', "r") as f:
    data = f.read().split('\n')

def parseLine(line):
    m = re.match(r"\[(?P<jaar>\d+)-(?P<maand>\d+)-(?P<dag>\d+) (?P<uur>\d+):(?P<minuut>\d+)\] (?P<tekst>.*$)", line).groupdict()
    return m.values()

def guardChange(tekst):
    m = re.match(r".*#(?P<guardId>\d+).*$", tekst)

    try:
        return m.group('guardId')
    except:
        pass

for line in data:
    [jaar, maand, dag, uur, minuut, tekst] =  parseLine(line)

    # print(tekst)
    if guardChange(tekst):
        print (guardChange(tekst))
