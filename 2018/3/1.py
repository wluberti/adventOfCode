#! /usr/bin/env python3

import re

with open("input.txt", "r") as f:
    data = f.read().split("\n")

SIZE = 1000
canvas = []
overlapCount = 0

for i in range(SIZE):
    canvas.append([0] * SIZE)    

def fillCanvas(xpos, ypos, width, height):
    global overlapCount, canvas
    for x in range(width):
        for y in range(height):
            canvas[xpos + x][ypos + y] += 1

            if canvas[xpos + x][ypos + y] == 2:
                overlapCount += 1

for line in data:
    m = re.match(r"#(?P<id>\d+) @ (?P<xpos>\d+),(?P<ypos>\d+): (?P<width>\d+)x(?P<height>\d+)", line)
    fillCanvas(
        int(m.group('xpos')),
        int(m.group('ypos')),
        int(m.group('width')),
        int(m.group('height'))
    )

print(overlapCount)