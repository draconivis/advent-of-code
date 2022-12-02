if __name__ == '__main__':
    elves = []
    with open('./input', 'r') as f:
        lines = f.readlines()
        temp_elf = 0
        for line in lines:
            if line is not '\n':
                print('single line: ' + line)
                line = int(line)
                temp_elf += line
            else:
                print('one elf: ' + temp_elf.__str__())
                elves.append(temp_elf)
                temp_elf = 0

    # part 1
    elves = sorted(elves, reverse=True)
    print('most calories on an elf: ' + elves[0].__str__())
    # part 2
    print("top three elves' total claories: " + (elves[0] + elves[1] + elves[2]).__str__())