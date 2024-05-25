<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <h1 class="text-center font-bold text-2xl my-4">Implementasi Algoritma Sequential Search</h1>
    <div class="bg-zinc-200 mx-auto mt-3 w-3/5 rounded">
        <div class="p-5">
             <input type="text" id="searchInput" class="p-2 rounded mb-3" placeholder="Search...">
            <table class="min-w-full border-collpse bg-white border border-gray-300 rounded-lg">
                <thead>
                    <tr>
                        <th class="p-4 border border-gray-300">Nama Kasir</th>
                        <th class="p-4 border border-gray-300">Kategori</th>
                        <th class="p-4 border border-gray-300">Nama Barang</th>
                        <th class="p-4 border border-gray-300">Jumlah di Beli</th>  
                        <th class="p-4 border border-gray-300">Harga</th> 
                        <th class="p-4 border border-gray-300">Total</th>
                    </tr>
                </thead>
                <tbody id="tableBody">

                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function fetchData() {
            try {
                const response = await fetch('/data');
                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        function searchTable(data, searchTerm){
            searchTerm = searchTerm.toLowerCase();
            return data.filter(item => {
                return Object.values(item).some(value =>
                    value.toString().toLowerCase().includes(searchTerm)
                );
            });
        }

        function renderTable(data){
            const tableBody = document.getElementById('tableBody');
            tableBody.innerHTML = '';

            data.forEach(item => {
                const row = document.createElement('tr');
                Object.values(item).forEach(value => {
                    const cell = document.createElement('td');
                    cell.textContent = value;
                    cell.className = 'p-4 border border-gray-300 text-center'
                    row.appendChild(cell);
                });
                tableBody.appendChild(row);
            });
        }

        document.getElementById('searchInput').addEventListener('input', async function(){
            const searchTerm = this.value;
            const data = await fetchData();
            const hasilPencarian = searchTable(data, searchTerm);
            renderTable(hasilPencarian);
        });

        document.addEventListener('DOMContentLoaded', async function(){
            const data = await fetchData();
            renderTable(data);
        })
    </script>
</body>
</html>