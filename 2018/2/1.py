#! /usr/bin/env python3

with open("input.txt", "r") as f:
    data = f.readlines()

count2 = 0
count3 = 0

for serial in data:
    chars = []

    for pos in range(len(serial)):
        char = serial[pos]
        if char == '\n':
            continue
        if char not in chars:
            num = serial.count(char)
            if num > 1 and num not in chars:
                chars.append(num)

    if 2 in chars:
        count2 = count2 + 1

    if 3 in chars:
        count3 = count3 + 1

print (count2 * count3)