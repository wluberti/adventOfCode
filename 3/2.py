#! /usr/bin/env python3

import re

with open("input.txt", "r") as f:
    data = f.read().split("\n")

SIZE = 1000
canvas = []

for i in range(SIZE):
    canvas.append([[]] * SIZE)    

for line in data:
    m = re.match(r"#(?P<id>\d+) @ (?P<xpos>\d+),(?P<ypos>\d+): (?P<xsize>\d+)x(?P<ysize>\d+)", line)

    for x in range(int(m.group('xsize'))):
        for y in range(int(m.group('ysize'))):
            if not m.group('id') in canvas[int(m.group('xpos')) + x][int(m.group('ypos')) + y]:
                canvas[int(m.group('xpos')) + x][int(m.group('ypos')) + y].append(m.group('id'))

for x in canvas:
    for y in x:
        if len(y) == 1:
            print(y)
