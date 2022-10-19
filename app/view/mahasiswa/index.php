<h1>Mahasiswa</h1>
<?php
foreach ($data['mhs'] as $mahasiswa) :
?>
    <ul>

        <li>
            <?=$mahasiswa['id']?>
        </li>
        <li>
            <?=$mahasiswa['nim']?>
        </li>
        <li>
            <?=$mahasiswa['nama']?>
        </li>
        <li>
            <?=$mahasiswa['jurusan']?>
        </li>
    </ul>

<?php
endforeach
?>