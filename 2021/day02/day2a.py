#! /usr/bin/env python3

with open('input.txt') as input:
    data = input.readlines()

position = 0
depth = 0

for line in data:
    direction, value = line.split(' ')

    if direction == 'forward':
        position += int(value)

    if direction == 'down':
        depth += int(value)

    if direction == 'up':
        depth -= int(value)

total = position * depth
print(total)