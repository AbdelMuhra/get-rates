<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        #rates-table th,
        #rates-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        #get-rates {
            padding: 10px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <button id="get-rates">Get Rates</button>
    <table id="rates-table">
        <thead>
            <tr>
                <th>Currency</th>
                <th>Rate</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rates['forex'] as $currency => $rate)
                <tr>
                    <td>{{ $currency }}</td>
                    <td>{{ $rate }}</td>
                </tr>
            @endforeach
            @foreach ($rates['crypto'] as $currency => $rate)
                <tr>
                    <td>{{ $currency }}</td>
                    <td>{{ $rate }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function() {
            $("#get-rates").click(function() {
                $.ajax({
                    url: "/get-rates",
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        console.log(data);

                        $("#rates-table tbody").empty();

                        $.each(data['forex'], function(currency, rate) {
                            $("#rates-table tbody").append("<tr><td>" + currency +
                                "</td><td>" + rate + "</td></tr>");
                        });

                        $.each(data['crypto'], function(currency, rate) {
                            $("#rates-table tbody").append("<tr><td>" + currency +
                                "</td><td>" + rate + "</td></tr>");
                        });

                    },
                    error: function(xhr, status, error) {
                        alert("Error: " + error);
                    }
                });
            });
        });
    </script>
</body>

</html>
