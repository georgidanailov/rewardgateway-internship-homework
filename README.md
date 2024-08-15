# Lecture 1 Practice Calculator App

## Overview
This **command-line calculator application** performs basic arithmetic operations. The user specifies the type of operation, the operator, and the two numeric parameters to be used. The application then outputs the result or an error message if the input is invalid.

## Usage
The application is executed from the command line and accepts the following parameters:

- **`--type`** (required): Specifies the type of operation. Currently, only `"arithmetic"` is supported.
- **`--operator`** (required): Specifies the arithmetic operation to perform. Supported operators are:
  - `"plus"`: Adds `param1` and `param2`.
  - `"minus"`: Subtracts `param2` from `param1`.
  - `"multiply"`: Multiplies `param1` by `param2`.
  - `"divide"`: Divides `param1` by `param2`. Returns an error if `param2` is zero.
- **`--param1`** (required): The first numeric parameter.
- **`--param2`** (required): The second numeric parameter.

## Example Commands

### Addition

php calculator.php --type=arithmetic --operator=plus --param1=5 --param2=3

# Lecture 1 Practice Figures App

## Overview
This **command-line application** calculates the area and perimeter of various shapes including triangles, squares, and circles. The user specifies the type of calculation, the shape, and the necessary dimensions to perform the calculation. The application then outputs the result or an error message if the input is invalid.

## Usage
The application is executed from the command line and accepts the following parameters:

- **`--type`** (required): Specifies the type of calculation. Valid options are `"shape"`.
- **`--calculation`** (required): Specifies the calculation to perform. Valid options are `"area"` or `"perimeter"`.
- **`--shape`** (required): Specifies the shape. Supported shapes are:
  - `"triangle"`
  - `"square"`
  - `"circle"`
- **`--radius`** (optional): The radius of a circle.
- **`--side`** (optional): The side length of a square.
- **`--base`** (optional): The base of a triangle.
- **`--height`** (optional): The height of a triangle.
- **`--side1`**, **`--side2`**, **`--side3`** (optional): The three sides of a triangle.

## Examples

### Circle Area

php figures.php --type=shape --calculation=area --shape=circle --radius=10

# System Requirements

These applications require PHP Version 8.0 or later.
