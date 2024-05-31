package main

import (
	"bufio"
	"fmt"
	"log"
	"os"
	"regexp"
	"strconv"
)

func part1() {
	// open file
	f, err := os.Open("input")
	if err != nil {
		log.Fatal(err)
	}
	// remember to close the file at the end of the program
	defer f.Close()

	// read the file line by line using scanner
	scanner := bufio.NewScanner(f)

	expression, err := regexp.Compile(`\d`)

	if err != nil {
		panic(err)
	}

	sum := 0
	for scanner.Scan() {
		// Version 1
		// line := scanner.Text()
		// // do something with a line
		// // fmt.Printf("line: %s\n", line)
		//
		// firstInt := "0"
		// lastInt := "0"
		// for i, char := range line {
		// 	// fmt.Printf("char: %s\n", string(char))
		//
		// 	// string to int
		// 	_, err := strconv.Atoi(string(char))
		//
		// 	if err != nil {
		// 		// ... handle error
		// 		continue
		// 	}
		//
		// 	if firstInt != "0" {
		// 		lastInt = string(line[i])
		// 	}
		//
		// 	if firstInt == "0" {
		// 		firstInt = string(line[i])
		// 	}
		// 	// fmt.Printf("firstInt: %s, lastInt: %s\n", firstInt, lastInt)
		// }
		//
		// if firstInt == "0" && lastInt != "0" {
		// 	firstInt = lastInt
		// } else if lastInt == "0" && firstInt != "0" {
		// 	lastInt = firstInt
		// }
		//
		// numberString := firstInt + lastInt
		// number, err := strconv.Atoi(numberString)
		// if err != nil {
		// 	// ... handle error
		// 	panic(err)
		// }

		// Version 2
		// fmt.Printf("line: %s\n", scanner.Text())
		elements := expression.FindAll(scanner.Bytes(), -1)
		// fmt.Printf("matched elements: %q\n", elements)

		// firstIntString := convertNumberToDigit(string(elements[0]))
		// lastIntString := convertNumberToDigit(string(elements[len(elements)-1]))
		// fmt.Printf("first: %s, last: %s\n", firstIntString, lastIntString)
		//
		// numberString := firstIntString + lastIntString
		numberString := string(elements[0]) + string(elements[len(elements)-1])
		// fmt.Printf("numberstring: %s\n", numberString)
		number, err := strconv.Atoi(numberString)

		if err != nil {
			panic(err)
		}
		// fmt.Printf("number: %d\n", number)

		sum += number
	}

	if err := scanner.Err(); err != nil {
		log.Fatal(err)
	}
	fmt.Printf("sum: %d\n", sum) // correct answer: 54304
}

func part2() {
	// open file
	f, err := os.Open("input")
	if err != nil {
		panic(err)
	}
	// remember to close the file at the end of the program
	defer f.Close()

	// read the file line by line using scanner
	scanner := bufio.NewScanner(f)

	expression, err := regexp.Compile(`((oneight|threeight|fiveight|nineight|eightwo|eighthree|sevenine)|(one|two|three|four|five|six|seven|eight|nine))|\d`)

	if err != nil {
		panic(err)
	}

	sum := 0
	for scanner.Scan() {
		fmt.Printf("line: %s\n", scanner.Text())
		elements := expression.FindAll(scanner.Bytes(), -1)
		fmt.Printf("matched elements: %q\n", elements)

		firstIntString := convertNumberToDigit(string(elements[0]))
		lastIntString := convertNumberToDigit(string(elements[len(elements)-1]))
		fmt.Printf("first: %s, last: %s\n", firstIntString, lastIntString)
		//
		// numberString := firstIntString + lastIntString
		numberString := convertNumberToDigit(string(elements[0])) + convertNumberToDigit(string(elements[len(elements)-1]))
		// fmt.Printf("numberstring: %s\n", numberString)
		number, err := strconv.Atoi(numberString)

		if err != nil {
			panic(err)
		}
		// fmt.Printf("number: %d\n", number)

		sum += number

	}

	fmt.Printf("sum: %d\n", sum) // correct answer:
}

func convertNumberToDigit(intString string) string {

	switch intString {
	case "one":
		return "1"
	case "two":
		return "2"
	case "three":
		return "3"
	case "four":
		return "4"
	case "five":
		return "5"
	case "six":
		return "6"
	case "seven":
		return "7"
	case "eight":
		return "8"
	case "nine":
		return "9"
	case "oneight":
		return "18"
	case "threeight":
		return "38"
	case "fiveight":
		return "58"
	case "nineight":
		return "98"
	case "eightwo":
		return "82"
	case "eighthree":
		return "83"
	case "sevenine":
		return "79"
	default:
		return intString
	}
}

func main() {
	part1()
	part2()
}
