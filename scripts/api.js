async function getHelyRecords() {
    const response = await fetch('http://localhost/beadando2/server/api.php', { method: 'GET' });
    const data = await response.json();
    
    //document.getElementById('getResults').innerText = JSON.stringify(data, null, 2);
    const table = document.getElementById('getResults');
    table.innerHTML = ''; 

    const headerRow = table.createTHead().insertRow(0);
    for (const key in data[0]) {
        const th = document.createElement('th');
        th.textContent = key;
        headerRow.appendChild(th);
    }

    data.forEach(rowData => {
        const row = table.insertRow(-1);
        for (const key in rowData) {
            const cell = row.insertCell(-1);
            cell.textContent = rowData[key];
        }
    });
}

async function addHelyRecord() {
    const telepules = document.getElementById('telepules').value;
    const utca = document.getElementById('utca').value;
    
    const response = await fetch('http://localhost/beadando2/server/api.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ telepules, utca }),
    });

    const result = await response.text();
    alert(result);
}

async function updateHelyRecord() {
    const id = document.getElementById('updateId').value;
    const telepules = document.getElementById('updateTelepules').value;
    const utca = document.getElementById('updateUtca').value;

    const response = await fetch('http://localhost/beadando2/server/api.php', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id, telepules, utca }),
    });

    const result = await response.text();
    alert(result);
}

async function deleteHelyRecord() {
    const id = document.getElementById('deleteId').value;

    const response = await fetch('http://localhost/beadando2/server/api.php', {
        method: 'DELETE',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ id }),
    });

    const result = await response.text();
    alert(result);
}