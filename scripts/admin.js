$(document).ready(function () {
    $("#fetchData").on("click", function (e) {
        e.preventDefault();

        
        var szerelo = $("#szereloSelect").val();
        var telepules = $("#telepulesSelect").val();
        var datum = $("#datum").val();
        
        $.ajax({
            type: "POST",
            url: "http://localhost/beadando2/admin", 
            data: {
                szerelo: szerelo,
                telepules: telepules,
                datum: datum
             },
             success: function (response) {
                 
                 if (response) {
                    
                    var html = "<table border='1' class='admin-table'>";
                    for (var key in response) {
                        html += "<tr><td> <strong>" + key + ":</strong></td><td>" + response[key] + "</td></tr>";
                    }
                    html += "</table>";
                    
                    var hiddenInputs = "<input type='hidden' name='szerelo' value='" + szerelo + "' />";
                    hiddenInputs += "<input type='hidden' name='telepules' value='" + telepules + "' />";
                    hiddenInputs += "<input type='hidden' name='datum' value='" + datum + "' />";

                    $("#result").html(html + "<form action='http://localhost/beadando2/admin' method='POST'>" + hiddenInputs + "<input type='hidden' name='pdf' value='true'/> <input type='submit' value='Letőltés' class='download'/> </form>");
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
