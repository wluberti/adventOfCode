#! /usr/bin/env python3

with open('input.txt') as f:
    datalist = list(f.readline().strip())

go = True
prev = ''
found = ''

while(go):
    for index, char in enumerate(datalist):
        if char == prev.swapcase():
            del datalist[index]
            del datalist[index - 1]
            prev = ''
            found = 'something'
            break
        else:
            found = 'nothing'
        
        prev = char
    
    if found == 'nothing':
        print(len(''.join(datalist)))
        go = False
