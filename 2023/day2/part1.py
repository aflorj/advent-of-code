with open("./2023/day2/input.txt", "r") as lines:
     sum = 0
     for line in lines:
          split = line.split(": ")
          gameIndex = int(split[0].split(" ")[1])
          gameInfo = split[1]
          rounds = gameInfo.split("; ")
          print(len(rounds))
          possibleRounds = 0
          for round in rounds:
               draws = round.split(", ")
               possibleDraws = 0
               for draw in draws:
                    pair = draw.split(" ")
                    if 'green' in pair[1]:
                         if int(pair[0]) <= 13:
                              possibleDraws += 1
                    if 'red' in pair[1]:
                         if int(pair[0]) <= 12:
                              possibleDraws += 1
                    if 'blue' in pair[1]:
                         if int(pair[0]) <= 14:
                              possibleDraws += 1
                    
               if possibleDraws == len(draws):
                    possibleRounds += 1
          if possibleRounds == len(rounds):
               sum += gameIndex
     print('sum: ', sum)