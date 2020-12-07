#! /usr/bin/env python3

import math

total = 0

with open('bron.txt', 'r') as file:
    data = file.readlines()
    for line in data:

        # Fuel for mass
        fuel_for_mass = (math.floor(int(line) / 3) - 2)
        total = total + fuel_for_mass

        # Fuel for fuel
        fuel_for_fuel = (math.floor(fuel_for_mass / 3) - 2)
        while fuel_for_fuel > 0:
            total = total + fuel_for_fuel
            fuel_for_fuel = (math.floor(fuel_for_fuel / 3) - 2)        
        
print(total)