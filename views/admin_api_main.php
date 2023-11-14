<h1>Hely api</h1>

<h2>Get Hely Records</h2>
    <button onclick="getHelyRecords()">Get Hely Records</button>
    <h2>Add New Hely Record</h2>
    <form id="addForm">
        Telepules: <input type="text" id="telepules" required><br>
        Utca: <input type="text" id="utca" required><br>
        <button type="button" onclick="addHelyRecord()">Add Hely Record</button>
    </form>

    <h2>Update Hely Record</h2>
    <form id="updateForm">
        Id: <input type="text" id="updateId" required><br>
        Telepules: <input type="text" id="updateTelepules"><br>
        Utca: <input type="text" id="updateUtca"><br>
        <button type="button" onclick="updateHelyRecord()">Update Hely Record</button>
    </form>

    <h2>Delete Hely Record</h2>
    <form id="deleteForm">
        Id: <input type="text" id="deleteId" required><br>
        <button type="button" onclick="deleteHelyRecord()">Delete Hely Record</button>
    </form>
    <table id="getResults"></table>
    <script src="<?php echo SITE_ROOT?>scripts/api.js"></script>