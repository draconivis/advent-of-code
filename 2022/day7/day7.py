COMMAND_LINE = /\$ (\w+)( \.\.|\w+)?/

with open('input', 'r') as f:
    lines = f.readlines()

    for line in lines:
