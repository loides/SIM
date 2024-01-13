<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quadratic Equation Solver</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Quadratic Equation Solver</h2>
        <form>
            <div class="form-group">
                <label for="a">Enter the coefficient a:</label>
                <input type="number" class="form-control" id="a" name="a" placeholder="Enter a">
            </div>
            <div class="form-group">
                <label for="b">Enter the coefficient b:</label>
                <input type="number" class="form-control" id="b" name="b" placeholder="Enter b">
            </div>
            <div class="form-group">
                <label for="c">Enter the coefficient c:</label>
                <input type="number" class="form-control" id="c" name="c" placeholder="Enter c">
            </div>
            <button type="button" class="btn btn-primary" onclick="solveQuadratic()">Solve</button>
            <div class="mt-3">
                <label for="equation">Equation:</label>
                <span id="equation"></span>
            </div>
            <div class="mt-3">
                <label for="x1">Root 1:</label>
                <span id="x1"></span>
            </div>
            <div>
                <label for="x2">Root 2:</label>
                <span id="x2"></span>
            </div>
        </form>
    </div>

    <script>

        function isNumeric(x) {
            return !isNan(parseFloat(x)) && isFinite(x);
        }

        function solveQuadratic() {
            const a = document.getElementById("a").value;
            const b = document.getElementById("b").value;
            const c = document.getElementById("c").value;

            if(!isNumeric(a) || !isNumeric(b) || !isNumeric(c) ) {
                alert ("inputs are not numeric...");
            }

            // Make an Ajax request to the local server for calculation
            const url = `http://localhost/webapp/app.php?service=rootValues&a=${a}&b=${b}&c=${c}`;
            const xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);

            xhr.onload = function() {
                if (xhr.status === 200) {
                    try {

                        const response = JSON.parse(xhr.responseText);
                        document.getElementById("equation").textContent = response.equation;    
                        document.getElementById("x1").textContent = response.x1;
                        document.getElementById("x2").textContent = response.x2;
                    } catch (error) {
                        console.error("Error parsing JSON response:", error);
                    }
                } else {
                    console.error("Error: Request failed with status", xhr.status);
                }
            };

            xhr.send();
        }
    </script>

    <!-- Include Bootstrap JS and jQuery, not really necessary in this form -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
