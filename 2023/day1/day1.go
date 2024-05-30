package main

import (
	"bufio"
	"fmt"
	"log"
	"os"
	"strconv"
)

func main() {
	// open file
	f, err := os.Open("input")
	if err != nil {
		log.Fatal(err)
	}
	// remember to close the file at the end of the program
	defer f.Close()

	// read the file line by line using scanner
	scanner := bufio.NewScanner(f)

	sum := 0
	for scanner.Scan() {
		line := scanner.Text()
		// do something with a line
		fmt.Printf("line: %s\n", line)

		firstInt := "0"
		lastInt := "0"
		for i, char := range line {
			fmt.Printf("char: %s\n", string(char))

			// string to int
			_, err := strconv.Atoi(string(char))

			if err != nil {
				// ... handle error
				continue
			}

			if firstInt != "0" {
				lastInt = string(line[i])
			}

			if firstInt == "0" {
				firstInt = string(line[i])
			}
			fmt.Printf("firstInt: %s, lastInt: %s\n", firstInt, lastInt)
		}

		if firstInt == "0" && lastInt != "0" {
			firstInt = lastInt
		} else if lastInt == "0" && firstInt != "0" {
			lastInt = firstInt
		}

		numberString := firstInt + lastInt
		number, err := strconv.Atoi(numberString)
		if err != nil {
			// ... handle error
			panic(err)
		}
		sum += number
	}

	if err := scanner.Err(); err != nil {
		log.Fatal(err)
	}
	fmt.Printf("sum: %d\n", sum) // correct answer: 54304
}
