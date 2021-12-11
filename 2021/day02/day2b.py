#! /usr/bin/env python3

with open('input.txt') as input:
    data = input.readlines()

position = 0
depth = 0
aim = 0

for line in data:
    direction, value = line.split(' ')

    if direction == 'forward':
        position += int(value)
        depth += (aim * int(value))

    if direction == 'down':
        aim += int(value)

    if direction == 'up':
        aim -= int(value)

total = position * depth
print(total)