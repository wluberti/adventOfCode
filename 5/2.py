#! /usr/bin/env python3

with open('input.txt') as f:
    data = f.readline().strip()

alphabet = 'abcdefghijklmnopqrstvuwxyz'

occurences = {}
for letter in alphabet:
    datalist = data.replace(letter, "")
    datalist = list(datalist.replace(letter.upper(), ""))

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
            occurences[letter] = len(''.join(datalist))
            print(occurences)
            go = False

print (max(occurences, key = occurences.get))