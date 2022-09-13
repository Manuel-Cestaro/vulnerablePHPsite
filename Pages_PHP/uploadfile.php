<?php
        session_start();
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Upload</title>
        <style>
                table {
                  font-family: arial, sans-serif;
                  border-collapse: collapse;
                  width: 100%;
                }

                td, th {
                  border: 1px solid #dddddd;
                  text-align: left;
                  padding: 8px;
                }

                tr:nth-child(even) {
                  background-color: #dddddd;
                }
        </style>
</head>
<body>

        <h2>Upload</h2>

        <table>
          <tr>
                <th>File Name</th>
          </tr>
          <?php
                require_once 'connessione.php';
                //$idUtente=$_SESSION['id'];
                $idUtente=1;
                echo $idUtente.'<br>';
                $sql = " SELECT * FROM users
                INNER JOIN files ON files.user_id=users.id
                WHERE users.id='$idUtente'";

                $risultato=$conn->query($sql); //eseguo la query $risultato è una tabella temporanea
                while ($riga=$risultato->fetch_assoc()) //$riga è un array associativo, fetch_assoc col while estrae tutti campi e li associa a $riga
                {
                        $file=$riga["file_name"];
                        print("<tr><td><a href=\"/upload/".$file."\">$file</a></td>");

                        print("</td></tr>");
                }
        ?>

        </table>
        <br><br>

        <form action="upload.php" method="post" enctype="multipart/form-data">
          Select image to upload:
          <input type="file" name="fileToUpload" id="fileToUpload">
          <input type="submit" value="Upload Image" name="submit">
        </form>


</body>
</html>