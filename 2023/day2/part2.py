with open("./2023/day2/input.txt", "r") as lines:
     power = 0
     for line in lines:
          split = line.split(": ")
          gameIndex = int(split[0].split(" ")[1])
          gameInfo = split[1]
          rounds = gameInfo.split("; ")
          lowestGreen = 0
          lowestRed = 0
          lowestBlue = 0
          for round in rounds:
               draws = round.split(", ")
               for draw in draws:
                    pair = draw.split(" ")
                    if 'green' in pair[1]:
                         if lowestGreen == 0:
                              lowestGreen = int(pair[0])
                         elif int(pair[0]) > lowestGreen:
                              lowestGreen = int(pair[0])
                    if 'red' in pair[1]:
                           if lowestRed == 0:
                              lowestRed = int(pair[0])
                           elif int(pair[0]) > lowestRed:
                              lowestRed = int(pair[0])
                    if 'blue' in pair[1]:
                           if lowestBlue == 0:
                              lowestBlue = int(pair[0])
                           elif int(pair[0]) > lowestBlue:
                              lowestBlue = int(pair[0])
          power += lowestGreen * lowestRed * lowestBlue
     print('power: ', power)