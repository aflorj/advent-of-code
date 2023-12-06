with open("./2023/day3/test.txt", "r") as input:
    input_str = input.read()
    lines = input_str.strip().split('\n')
    grid = [list(line) for line in lines]

    # print(grid[0][0])s

    for x in range(0, len(grid[0])):
        for y in range(0, len(grid)):
               print('x: ', x, " y: ", y, ' ima vrednost: ', grid[x][y])

    #  lines = input.split("\n")
    #  print(lines)
    #  grid = 
    #  for verticalIndex, line in enumerate(lines):
        #   for horizontalIndex, char in enumerate(line):
            #    print(horizontalIndex, " :", char)