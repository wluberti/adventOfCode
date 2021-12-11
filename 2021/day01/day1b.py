#! /usr/bin/env python3

with open('input.txt') as input:
    data = list(map(int, input.read().splitlines()))

previous_three_measurement = 0
answer = 0

for num, current_point in enumerate(data):
    if num == 0:
        A, B, C = current_point, None, None

        print(f'Datapoint {num}. Depth: {current_point} (N/A - preparing, first data point)')
        continue
    if num == 1:
        A, B, C = current_point, A, None

        print(f'Datapoint {num}. Depth: {current_point} (N/A - preparing, second data point)')
        continue

    A, B, C = current_point, A, B
    current_three_measurement = A + B + C

    if num == 2:
        print(f'Datapoint {num}. Depth: {current_three_measurement} (N/A - no previous sum)')
        continue

    if current_three_measurement - previous_three_measurement > 0:
        answer += 1
        print(f'{current_point} (increased) total is now {answer}')
    else:
        print(f'{current_point} (decreased)')

    previous_three_measurement = current_three_measurement

print(f'Answer: {answer}')
