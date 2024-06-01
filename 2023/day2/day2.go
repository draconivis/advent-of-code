package main

import (
	"bufio"
	"fmt"
	"log"
	"os"
	// "strings"
	"github.com/dlclark/regexp2"
)

func part1() {
	// input:
	// Game 1: 3 blue, 4 red; 1 red, 2 green, 6 blue; 2 green
	// Game 2: 1 blue, 2 green; 3 green, 4 blue, 1 red; 1 green, 1 blue
	// Game 3: 8 green, 6 blue, 20 red; 5 blue, 4 red, 13 green; 5 green, 1 red
	// Game 4: 1 green, 3 red, 6 blue; 3 green, 6 red; 3 green, 15 blue, 14 red
	// Game 5: 6 red, 1 blue, 3 green; 2 blue, 1 red, 2 green
	// Determine which games would have been possible if the bag had been loaded with only 12 red cubes, 13 green cubes, and 14 blue cubes. What is the sum of the IDs of those games?

	// open file
	f, err := os.Open("input")
	if err != nil {
		log.Fatal(err)
	}
	// remember to close the file at the end of the program
	defer f.Close()

	// read the file line by line using scanner
	scanner := bufio.NewScanner(f)

	// this regex doesn't work because it thinks its a named group...
	gameIdExpression := regexp2.MustCompile(`(?<=Game )\d+`, regexp2.RE2)

	sum := 0
	for scanner.Scan() {
		// Version 2
		fmt.Printf("line: %s\n", scanner.Text())
		line := scanner.Text()
		gameId, err := gameIdExpression.FindStringMatch(line)
		if err != nil {
			panic(err)
		}
		fmt.Printf("gameId: %s\n", gameId)
		// gameWId := strings.Split(line, ":")[0]
		// diceparts := strings.Split(strings.Split(line, ":")[1], ";")
		// fmt.Printf("gamepart: %s, diceparts: %q\n", gameWId, diceparts)

		// sum += number
	}

	if err := scanner.Err(); err != nil {
		log.Fatal(err)
	}
	fmt.Printf("sum: %d\n", sum) // correct answer: 54304
}

func part2() {}

func main() {
	part1()
	part2()
}
