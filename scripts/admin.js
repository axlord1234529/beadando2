$(document).ready(function () {
    $("#fetchData").on("click", function (e) {
        e.preventDefault();

        // Get selected values from the form
        var szerelo = $("#szereloSelect").val();
        var telepules = $("#telepulesSelect").val();
        var datum = $("#datum").val();
        console.log(szerelo);
        console.log("adasdasd");
        // Make AJAX request
        $.ajax({
            type: "POST",
            url: "http://localhost/beadando2/admin", // Your PHP script URL
            data: {
                szerelo: szerelo,
                telepules: telepules,
                datum: datum
             },
             success: function (response) {
                 // Handle the response and update the result div
                 if (response) {
                    // Assuming response is a single object
                    var html = "<table border='1'>";
                    for (var key in response) {
                        html += "<tr><td>" + key + "</td><td>" + response[key] + "</td></tr>";
                    }
                    html += "</table>";
                    
                    var hiddenInputs = "<input type='hidden' name='szerelo' value='" + szerelo + "' />";
                    hiddenInputs += "<input type='hidden' name='telepules' value='" + telepules + "' />";
                    hiddenInputs += "<input type='hidden' name='datum' value='" + datum + "' />";

                    $("#result").html(html + "<form action='http://localhost/beadando2/admin' method='POST'>" + hiddenInputs + "<input type='hidden' name='pdf' value='true'/> <input type='submit' value='Letőltés'/> </form>");
                } else {
                    $("#result").html("No data found");
                }
             },
             error: function (error) {
                 console.log("Error:", error);
             }
        });
    });
});
