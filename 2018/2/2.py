#! /usr/bin/env python3

with open("input.txt", "r") as f:
    data = f.read().split("\n")

found = []

def hamming(x, y):
    dist = 0
    letters = []
    for i in range(len(x)):
        if x[i] != y[i]:
            dist += 1
            letters.append(x[:i] + x[i+1:])
    return dist, letters

for serial in data:
    datacopy = data[:]
    for x in range(len(data)):
        current = datacopy.pop()
        hammingValues = hamming(serial, current)
        if hammingValues[0] == 1:
            found.append(hammingValues[1])

print (found)