if __name__ == '__main__':
    prio = {
        "a": 1,
        "b": 2,
        "c": 3,
        "d": 4,
        "e": 5,
        "f": 6,
        "g": 7,
        "h": 8,
        "i": 9,
        "j": 10,
        "k": 11,
        "l": 12,
        "m": 13,
        "n": 14,
        "o": 15,
        "p": 16,
        "q": 17,
        "r": 18,
        "s": 19,
        "t": 20,
        "u": 21,
        "v": 22,
        "w": 23,
        "x": 24,
        "y": 25,
        "z": 26,
        "A": 27,
        "B": 28,
        "C": 29,
        "D": 30,
        "E": 31,
        "F": 32,
        "G": 33,
        "H": 34,
        "I": 35,
        "J": 36,
        "K": 37,
        "L": 38,
        "M": 39,
        "N": 40,
        "O": 41,
        "P": 42,
        "Q": 43,
        "R": 44,
        "S": 45,
        "T": 46,
        "U": 47,
        "V": 48,
        "W": 49,
        "X": 50,
        "Y": 51,
        "Z": 52,
    }

    items = []
    priority = 0
    # part 1
    with open('./input', 'r') as f:
        for line in f.readlines():
            item1 = line[:len(line) // 2]
            item2 = line[len(line) // 2:]
            # print(item1, item2)
            # print(str((set(item1) & set(item2)).pop()))
            priority += prio[(set(item1) & set(item2)).pop()]

    print('part 1 -> ' + priority.__str__())

    # part 2
    with open('./input', 'r') as f:
        all_groups = []
        temp_group = []
        priority = 0
        for line in f.readlines():
            if len(temp_group) < 3:
                temp_group.append(line.strip('\n'))
            else:
                all_groups.append(temp_group)
                temp_group = [line]
        # I have to append the last group here, because it is not added by the loop
        all_groups.append(temp_group)

        for group in all_groups:
            priority += prio[(set(group[0]) & set(group[1]) & set(group[2])).pop()]

    print('part 2 -> ' + priority.__str__())
