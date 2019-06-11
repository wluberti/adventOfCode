#! /usr/bin/env python3

import re

with open("input.txt", "r") as f:
    data = f.read().split("\n")

SIZE = 1000
canvas = []
overlapCount = 0

for i in range(SIZE):
    canvas.append([0] * SIZE)    

def fillCanvas(xpos, ypos, xsize, ysize):
    global overlapCount, canvas
    for x in range(xsize):
        for y in range(ysize):
            canvas[xpos + x][ypos + y] += 1

            if canvas[xpos + x][ypos + y] == 2:
                overlapCount += 1

for line in data:
    m = re.match(r"#(?P<id>\d+) @ (?P<xpos>\d+),(?P<ypos>\d+): (?P<xsize>\d+)x(?P<ysize>\d+)", line)
    fillCanvas(
        int(m.group('xpos')),
        int(m.group('ypos')),
        int(m.group('xsize')),
        int(m.group('ysize'))
    )

print(overlapCount)