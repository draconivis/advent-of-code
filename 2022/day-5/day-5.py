if __name__ == '__main__':
    # part 1
    #     [W]         [J]     [J]
    #     [V]     [F] [F] [S] [S]
    #     [S] [M] [R] [W] [M] [C]
    #     [M] [G] [W] [S] [F] [G]     [C]
    # [W] [P] [S] [M] [H] [N] [F]     [L]
    # [R] [H] [T] [D] [L] [D] [D] [B] [W]
    # [T] [C] [L] [H] [Q] [J] [B] [T] [N]
    # [G] [G] [C] [J] [P] [P] [Z] [R] [H]
    #  1   2   3   4   5   6   7   8   9

    stacks = {
        '1': ['G', 'T', 'R', 'W'],
        '2': ['G', 'C', 'H', 'P', 'M', 'S', 'V', 'W'],
        '3': ['C', 'L', 'T', 'S', 'G', 'M'],
        '4': ['J', 'H', 'D', 'M', 'W', 'R', 'F'],
        '5': ['P', 'Q', 'L', 'H', 'S', 'W', 'F', 'J'],
        '6': ['P', 'J', 'D', 'N', 'F', 'M', 'S'],
        '7': ['Z', 'B', 'D', 'F', 'G', 'C', 'S', 'J'],
        '8': ['R', 'T', 'B'],
        '9': ['H', 'N', 'W', 'L', 'C'],
    }

    instructions = []
    with open('./input', 'r') as f:
        for line in f.readlines():
            split_line = line.split(' ')
            from_stack = split_line[3].strip('\n')
            to_stack = split_line[5].strip('\n')
            amount = int(split_line[1].strip('\n'))
            # print(from_stack, to_stack, amount)
            instructions.append({'from': from_stack, 'to': to_stack, 'amount': amount})
    for instruction in instructions:
        for i in range(instruction.get('amount')):
            stacks[instruction.get('to')].append(stacks[instruction.get('from')].pop())
        # print(stack1[instruction.get('to')], stack1[instruction.get('from')])

    print(
        'part 1 -> ' + stacks['1'][len(stacks['1']) - 1].__str__() +
        stacks['2'][len(stacks['2']) - 1].__str__() +
        stacks['3'][len(stacks['3']) - 1].__str__() +
        stacks['4'][len(stacks['4']) - 1].__str__() +
        stacks['5'][len(stacks['5']) - 1].__str__() +
        stacks['6'][len(stacks['6']) - 1].__str__() +
        stacks['7'][len(stacks['7']) - 1].__str__() +
        stacks['8'][len(stacks['8']) - 1].__str__() +
        stacks['9'][len(stacks['9']) - 1].__str__() +
        '\n{1: ' + stacks['1'][len(stacks['1']) - 1].__str__() +
        '}, {2: ' + stacks['2'][len(stacks['2']) - 1].__str__() +
        '}, {3: ' + stacks['3'][len(stacks['3']) - 1].__str__() +
        '}, {4: ' + stacks['4'][len(stacks['4']) - 1].__str__() +
        '}, {5: ' + stacks['5'][len(stacks['5']) - 1].__str__() +
        '}, {6: ' + stacks['6'][len(stacks['6']) - 1].__str__() +
        '}, {7: ' + stacks['7'][len(stacks['7']) - 1].__str__() +
        '}, {8: ' + stacks['8'][len(stacks['8']) - 1].__str__() +
        '}, {9: ' + stacks['9'][len(stacks['9']) - 1].__str__() + '}')

    # part 2
    stacks = {
        '1': ['G', 'T', 'R', 'W'],
        '2': ['G', 'C', 'H', 'P', 'M', 'S', 'V', 'W'],
        '3': ['C', 'L', 'T', 'S', 'G', 'M'],
        '4': ['J', 'H', 'D', 'M', 'W', 'R', 'F'],
        '5': ['P', 'Q', 'L', 'H', 'S', 'W', 'F', 'J'],
        '6': ['P', 'J', 'D', 'N', 'F', 'M', 'S'],
        '7': ['Z', 'B', 'D', 'F', 'G', 'C', 'S', 'J'],
        '8': ['R', 'T', 'B'],
        '9': ['H', 'N', 'W', 'L', 'C'],
    }
    for instruction in instructions:
        crates_to_move = []
        for i in range(instruction.get('amount')):
            crates_to_move.append(stacks[instruction.get('from')].pop())
        crates_to_move.reverse()
        # print(crates_to_move)
        stacks[instruction.get('to')].extend(crates_to_move)
    print(
        'part 2 -> ' + stacks['1'][len(stacks['1']) - 1].__str__() +
        stacks['2'][len(stacks['2']) - 1].__str__() +
        stacks['3'][len(stacks['3']) - 1].__str__() +
        stacks['4'][len(stacks['4']) - 1].__str__() +
        stacks['5'][len(stacks['5']) - 1].__str__() +
        stacks['6'][len(stacks['6']) - 1].__str__() +
        stacks['7'][len(stacks['7']) - 1].__str__() +
        stacks['8'][len(stacks['8']) - 1].__str__() +
        stacks['9'][len(stacks['9']) - 1].__str__() +
        '\n{1: ' + stacks['1'][len(stacks['1']) - 1].__str__() +
        '}, {2: ' + stacks['2'][len(stacks['2']) - 1].__str__() +
        '}, {3: ' + stacks['3'][len(stacks['3']) - 1].__str__() +
        '}, {4: ' + stacks['4'][len(stacks['4']) - 1].__str__() +
        '}, {5: ' + stacks['5'][len(stacks['5']) - 1].__str__() +
        '}, {6: ' + stacks['6'][len(stacks['6']) - 1].__str__() +
        '}, {7: ' + stacks['7'][len(stacks['7']) - 1].__str__() +
        '}, {8: ' + stacks['8'][len(stacks['8']) - 1].__str__() +
        '}, {9: ' + stacks['9'][len(stacks['9']) - 1].__str__() + '}')
