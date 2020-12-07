#! /usr/bin/env python3

import os

__location__ = os.path.realpath(
    os.path.join(os.getcwd(), os.path.dirname(__file__)))

with open(os.path.join(__location__, "input.txt")) as file:
    data = [int(n) for n in file.read().split(',')]

counter = 0
while counter < (len(data)):
    intcode, readPos1, readPos2, writePos = data[counter:counter + 4]

    # print("Processing: {} {} {} {}".format(intcode, data[readPos1], data[readPos2], writePos))

    if intcode == 1:
        print("Adding {} and {} ({}), writing at position {}".format(data[readPos1], data[readPos2], data[readPos1] + data[readPos2], writePos))
        data[writePos] = data[readPos1] + data[readPos2]

    elif intcode == 2:
        print("Multiplying {} and {} ({}), writing at position {}".format(data[readPos1], data[readPos2], data[readPos1] * data[readPos2], writePos))
        data[writePos] = data[readPos1] * data[readPos2]

    elif intcode == 99:
        print("Found exit code at position {}".format(counter))
        print(data[0])
        exit(0)

    else:
        print("somthing went wrong!")
        exit(1)
    
    counter = counter + 4
