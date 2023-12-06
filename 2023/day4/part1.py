with open("./2023/day4/input.txt", "r") as lines:
     sum = 0
     for line in lines:
          splits = line.split(" | ")
          winningNumbers = list(filter(None,splits[0].split(": ")[1].strip().split(" ")))
          myNumbers = list(filter(None,splits[1].strip().split(" ")))
        #   print('winning: ', winningNumbers, " my: ", myNumbers)
          incommon = len(set(winningNumbers).intersection(myNumbers))
          if incommon == 1:
               sum += 1
          elif incommon > 1:
               sum += 2**(incommon-1)
     print('total pts: ', sum)