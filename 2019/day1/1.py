#! /usr/bin/env python3

import math

total = 0

with open('bron.txt', 'r') as file:
    data = file.readlines()
    for line in data:
        mass = int(line)
        total = total + (math.floor(mass / 3) - 2)

print(total)
