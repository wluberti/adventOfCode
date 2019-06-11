#! /usr/bin/env python3

import re

with open("input.txt", "r") as f:
    data = f.readlines()

outcome = 0

for val in data:
    m = re.match(r"([\+-])?(\d+)", val)
    if m.group(1) == '+':
        outcome = outcome + int(m.group(2))
    if m.group(1) == '-':
        outcome = outcome - int(m.group(2))

print(outcome)
