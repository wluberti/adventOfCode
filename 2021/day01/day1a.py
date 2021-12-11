#! /usr/bin/env python3

with open('input.txt') as input:
    data = list(map(int, input.read().splitlines()))

previous_point = None
answer = 0

for current_point in data:
    if previous_point == None:
        print(f'{current_point} (N/A - no previous measurement)')
        previous_point = current_point
        continue

    if current_point - previous_point > 0:
        answer += 1
        print(f'{current_point} (increased) total is now {answer}')
    else:
        print(f'{current_point} (decreased)')

    previous_point = current_point

print(f'Answer: {answer}')
