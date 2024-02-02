<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Demo Result</title>
</head>
<body>

    <h1>Array Demo Result</h1>

    <?php
        // Retrieve values from the form using $_POST to access the superglobal array which numRows numColls etc. are in.
        $numRows = isset($_POST['numRows']) ? (int)$_POST['numRows'] : 0;
        $numCols = isset($_POST['numCols']) ? (int)$_POST['numCols'] : 0;
        $minValue = isset($_POST['minValue']) ? (int)$_POST['minValue'] : 0;
        $maxValue = isset($_POST['maxValue']) ? (int)$_POST['maxValue'] : 0;

        // Function to determine if a value is positive or negative
        function positiveOrNegative($value) {
            if ($value == 0) {
                return "Zero";
            }

            return $value >= 0 ? "Positive" : "Negative";
        }

        // Make sure inputs are not incalculable by listing fail cases.
        if ($numRows <= 0 || $numCols <= 0 || $minValue >= $maxValue) {
            echo "<p>Invalid input. Please go back and enter valid values.</p>";
        } else {
            // Create a randomized 2D array
            $dataArray = [];
            for ($i = 0; $i < $numRows; $i++) {
                $row = [];
                for ($j = 0; $j < $numCols; $j++) {
                    $row[] = rand($minValue, $maxValue);
                }
                $dataArray[] = $row;
            }

            // Display array size, min value, and max value from the user input in arrayDemo.html
            echo "<p>Array Size: $numRows x $numCols</p>";
            echo "<p>Min Value: $minValue</p>";
            echo "<p>Max Value: $maxValue</p>";

            // Create a table with specified border length using nested and outer loops to create the rows and columns as necessary
            // this completed table is then echoed to the output
            echo "<table border='1'>";
            foreach ($dataArray as $row) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";


            // create and display the second table (row, sum, avg, std dev)
            //table lables
            echo "<table border='1'>";
            echo "<tc><td>Row</td></tc>";
            echo "<tc><td>Sum</td></tc>";
            echo "<tc><td>Avg</td></tc>";
            echo "<tc><td>Std Dev</td></tc>";

            $rowIndex = 0; // initializing variable to store row position
            //outputting the row number
            for ($i = 0; $i < $numRows; $i++) {
                $rowIndex = $i; 
                $sumRow = 0; // initializing variable to store row sum
                $stdevSum= 0; // initializing variable to store std dev summation

                for ($j = 0; $j < $numCols; $j++) { 
                    //calculating the sum of all the values in row
                    $sumRow += $dataArray[$i][$j]; 

                    //calculating the average of each row
                    $avgRow = $sumRow/$numCols;
                }

                //calculating the Std Dev (population)
                for ($j = 0; $j < $numCols; $j++) {
                    $stdevSub = ($dataArray[$i][$j]-$avgRow); //initialzing variable to store (value - mean)
                    $stdevSum += pow($stdevSub,2); //summation of all stdevsub squared
                }  
                $stdevRoot = number_format((sqrt($stdevSum/$numCols)),3); //square root with answer rounded to 3 decimal places
                $avgRow = number_format($avgRow, 3);

                // creating a table from the outputs
                echo "<tr><td>$rowIndex</td><td>$sumRow</td><td>$avgRow</td><td>$stdevRoot</td></tr>";
            }
            
            
            echo "<p><table></p>";
            // Create and display the third table with positive/negative row
            echo "<table border='1'>";
            foreach ($dataArray as $row) {
                // Original row
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";

                // Positive/Negative row
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . positiveOrNegative($value) . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    ?>

    <a href="arrayDemo.html">Click here to return</a>

</body>
</html>
