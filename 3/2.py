#! /usr/bin/env python3

import re

with open("input.txt", "r") as f:
    data = f.read().split("\n")

SIZE = 1000
canvas = []

for i in range(SIZE):
    canvas.append([[]] * SIZE)    

for line in data:
    m = re.match(r"#(?P<id>\d+) @ (?P<xpos>\d+),(?P<ypos>\d+): (?P<width>\d+)x(?P<height>\d+)", line)

    for y in range(int(m.group('height'))):
        for x in range(int(m.group('width'))):
            if not m.group('id') in canvas[int(m.group('ypos')) + y][int(m.group('xpos')) + x]:
                canvas[int(m.group('ypos')) + y][int(m.group('xpos')) + x].append(m.group('id'))

for y in canvas:
    for x in y:
        if len(x) == 1:
            print(x)
