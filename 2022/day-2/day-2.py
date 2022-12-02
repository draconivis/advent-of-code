def play(opponent, me):
    # rock beats scissors
    if opponent is 1 and me is 3:
        print(values['LOSS'] + me)
        return values['LOSS'] + me
    # scisssors beats paper and paper beats rock
    if opponent < me:
        print(values['WIN'] + me)
        return values['WIN'] + me
    # both the same
    if me is opponent:
        print(values['TIE'] + me)
        return values['TIE'] + me
    # opponent is stronger
    print(values['LOSS'] + me)
    return values['LOSS'] + me


if __name__ == '__main__':
    # 1st try - does not work for some reason
    #     values = {
    #         'WIN': 6,
    #         'TIE': 3,
    #         'LOSS': 0,
    #         'A': 1,  # rock
    #         'B': 2,  # paper
    #         'C': 3,  # scissors,
    #         'X': 1,  # rock
    #         'Y': 2,  # paper,
    #         'Z': 3,  # scissors
    #     }
    #     points = 0
    #     pointsArray = []
    #     with open('./input', 'r') as f:
    #         lines = f.readlines()
    #         # print(lines)
    #
    #         for line in lines:
    #             tempLine = []
    #             for letter in line:
    #                 if letter is not '\n' and letter is not " ":
    #                     tempLine.append(letter)
    #             opponent = values[tempLine[0]]
    #             me = values[tempLine[1]]
    #             points += play(opponent, me)
    #             pointsArray.append(play(opponent, me))
    #
    #     print(points)
    #     print(pointsArray)

    # 2nd try - this was correct
    values = {"A X": 4, "A Y": 8, "A Z": 3, "B X": 1, "B Y": 5, "B Z": 9, "C X": 7, "C Y": 2, "C Z": 6}
    points = 0
    with open('./input', 'r') as f:
        for line in f.readlines():
            print(line)
            points += values[line.strip('\n')]
    print(points)
