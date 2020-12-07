#! /usr/bin/env python3

import re

with open("input.txt", "r") as f:
    data = f.read().split("\n")

SIZE = 1000
canvas = []

for i in range(SIZE):
    canvas.append([[]] * SIZE)    

for line in data:
    m = re.match(r"#(?P<id>\d+) @ (?P<xpos>\d+),(?P<ypos>\d+): (?P<width>\d+)x(?P<height>\d+)", line).groupdict()

    claimId = m['id']
    xpos = int(m['xpos'])
    ypos = int(m['ypos'])
    width = int(m['width'])
    height = int(m['height'])

    for row in range(ypos, ypos + height):
        for column in range(xpos, xpos + width):
            if not claimId in canvas[row][column]:
                canvas[row][column].append(claimId)
                
for row in canvas:
    for column in row:
        if len(column) == 1:
            print(column)
            break
