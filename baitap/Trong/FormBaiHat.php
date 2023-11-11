<?php
include('../includes/header.html');
?>

<style>
    main {
        padding: 1rem;
    }
</style>

<main>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        button {
            margin: 5px;
            padding: 10px;
            border: 1px solid #333;
            border-radius: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 10px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:nth-child(odd) {
            background-color: #ddd;
        }
    </style>
    <h1>Bảng Xếp Hạng Bài Hát</h1>

    <form id="songForm">
        <label for="songName">Tên bài hát:</label>
        <input type="text" id="songName" required>
        
        <label for="songRank">Thứ hạng:</label>
        <input type="number" id="songRank" required>
        
        <button type="button" id="addSongButton">Thêm bài hát</button>
    </form>
    
    <button type="button" id="showRankingButton">Hiển thị bảng xếp hạng</button>

    <table id="rankingTable">
        <thead>
            <tr>
                <th>Thứ hạng</th>
                <th>Tên bài hát</th>
            </tr>
        </thead>
        <tbody id="rankingBody"></tbody>
    </table>

    <script>
        const songs = [];

        const songForm = document.getElementById('songForm');
        const songNameInput = document.getElementById('songName');
        const songRankInput = document.getElementById('songRank');
        const addSongButton = document.getElementById('addSongButton');
        const rankingTable = document.getElementById('rankingTable');
        const rankingBody = document.getElementById('rankingBody');
        const showRankingButton = document.getElementById('showRankingButton');

        addSongButton.addEventListener('click', () => {
            const songName = songNameInput.value;
            const songRank = parseInt(songRankInput.value);

            if (!songName || isNaN(songRank)) {
                alert('Vui lòng nhập tên bài hát và thứ hạng hợp lệ.');
                return;
            }

            songs.push({ rank: songRank, name: songName });
            songs.sort((a, b) => a.rank - b.rank);

            songNameInput.value = '';
            songRankInput.value = '';

            updateSongList();
        });

        showRankingButton.addEventListener('click', () => {
            songs.sort((a, b) => a.rank - b.rank);
            updateSongList();
        });

        function updateSongList() {
            rankingBody.innerHTML = '';

            for (let i = 0; i < songs.length; i++) {
                const row = rankingBody.insertRow(i);
                const rankCell = row.insertCell(0);
                const nameCell = row.insertCell(1);

                rankCell.textContent = songs[i].rank;
                nameCell.textContent = songs[i].name;
            }
        }
    </script>

</main>

<script>
    var tab = document.getElementById('index');
    tab.classList.add('active');
</script>

<?php
include('../includes/footer.php');
?>
