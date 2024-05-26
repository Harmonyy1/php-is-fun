<?php
// Database configuration
$servername = "localhost";
$username = "root"; // använd ditt MySQL-användarnamn
$password = ""; // använd ditt MySQL-lösenord
$dbname = "techassist_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission for new tickets
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_ticket'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $category = $conn->real_escape_string($_POST['category']);
    $priority = $conn->real_escape_string($_POST['priority']);

    $sql = "INSERT INTO tickets (title, description, category, priority) VALUES ('$title', '$description', '$category', '$priority')";

    if ($conn->query($sql) === TRUE) {
        $message = "Nytt ärende har skapats framgångsrikt!";
    } else {
        $message = "Fel: " . $sql . "<br>" . $conn->error;
    }
}

// Handle status update for tickets
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_status'])) {
    $id = intval($_POST['id']);
    $status = $conn->real_escape_string($_POST['status']);

    $sql = "UPDATE tickets SET status='$status' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        $message = "Ärendet har uppdaterats!";
    } else {
        $message = "Fel: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechAssistSolutions - Ärendehantering</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Skapa ett nytt ärende</h1>
        <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
        <form action="index.php" method="POST">
            <label for="title">Titel</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Beskrivning</label>
            <textarea id="description" name="description" required></textarea>

            <label for="category">Kategori</label>
            <select id="category" name="category">
                <option value="Teknisk support">Teknisk support</option>
                <option value="Fakturaförfrågningar">Fakturaförfrågningar</option>
                <option value="Produktfrågor">Produktfrågor</option>
                <option value="Allmänna förfrågningar">Allmänna förfrågningar</option>
                <option value="Klagomål">Klagomål</option>
            </select>

            <label for="priority">Prioritet</label>
            <select id="priority" name="priority">
                <option value="Låg">Låg</option>
                <option value="Medel">Medel</option>
                <option value="Hög">Hög</option>
                <option value="Akut">Akut</option>
            </select>

            <input type="submit" name="submit_ticket" value="Skicka in ärende">
        </form>

        <h1>Hantera ärenden</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titel</th>
                    <th>Beskrivning</th>
                    <th>Kategori</th>
                    <th>Prioritet</th>
                    <th>Status</th>
                    <th>Åtgärd</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM tickets";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['title']}</td>
                                <td>{$row['description']}</td>
                                <td>{$row['category']}</td>
                                <td>{$row['priority']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    <form action='index.php' method='POST'>
                                        <input type='hidden' name='id' value='{$row['id']}'>
                                        <select name='status'>
                                            <option value='Pågående' " . ($row['status'] == 'Pågående' ? 'selected' : '') . ">Pågående</option>
                                            <option value='Avslutad' " . ($row['status'] == 'Avslutad' ? 'selected' : '') . ">Avslutad</option>
                                        </select>
                                        <input type='submit' name='update_status' value='Uppdatera'>
                                    </form>
                                </td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Inga ärenden hittades</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
