with open("./2023/day1/input.txt", "r") as lines:
    sum = 0
    for line in lines:
        lineWithReplaces = line.replace("one", "o1e").replace('two', 't2o').replace('three', 't3e').replace('four', 'f4r').replace('five', 'f5e').replace('six', 's6x').replace('seven', 's7n').replace('eight', 'e8t').replace('nine', 'n9e').replace('zero', 'z0o')
        # print(lineWithReplaces)
        linenums = ''
        for char in lineWithReplaces:
            if char in '1234567890':
                linenums+=char
        sum+=int(linenums[0] + linenums[-1])
    print('sum: ', sum)