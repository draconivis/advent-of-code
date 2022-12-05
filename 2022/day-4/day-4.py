import collections

if __name__ == '__main__':
    # part 1
    with open('./input', 'r') as f:
        assignments = []
        for line in f.readlines():
            assignments.append(line.strip('\n').split(','))
        extented_assignments = []  # this will be the same as the pairs list, but 'filled out'
        # assignments -> [['4-94', '1-93'], ['32-38', '33-71'], ...]
        for assignment in assignments:
            # assignment -> ['32-38', '33-71']
            temp_pair = []
            for room_range in assignment:
                # room_range -> 33-71
                rooms = []
                # get start & end
                [start, end] = room_range.split('-')
                start = int(start)
                end = int(end) + 1  # bc range has exclusive end
                for room in range(start, end):
                    rooms.append(room)
                temp_pair.append(rooms)  # save it to the temporary pair
            extented_assignments.append(temp_pair)  # save it to the extended list
        # print(extented_assignments[0])

        contained = 0 # the number of assignments
        # https://stackoverflow.com/a/20789587
        for assignment in extented_assignments:
            if set(assignment[0]).issubset(set(assignment[1])):
                contained += 1
            elif set(assignment[1]).issubset(set(assignment[0])):
                contained += 1
        print('part 1 -> ' + contained.__str__())

        # part 2
        overlaps = 0
        # https://stackoverflow.com/a/5095171
        for assignment in extented_assignments:
            list1 = collections.Counter(assignment[0])
            print(list1)
            list2 = collections.Counter(assignment[1])
            if list((list1 & list2).elements()):
                overlaps += 1

    print('part 2 -> ' + overlaps.__str__())
