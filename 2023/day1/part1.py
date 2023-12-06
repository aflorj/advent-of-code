with open("./2023/day1/input.txt", "r") as lines:
    sum = 0
    for line in lines:
        linenums = ''
        for char in line:
            if char in '1234567890':
                linenums+=char
        sum+=int(linenums[0] + linenums[-1])
    print('sum: ', sum)