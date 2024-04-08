<!DOCTYPE html>
<html>
<head>
    <title>Add Blood Info</title>
    <link rel="stylesheet" type="text/css" href="st.css">
</head>

<body>
    <header>
        <h1>Blood Information</h1>
    </header>
    <main>
    <div class="container">
        <h2>Add Blood Info</h2>
        <form action="add_blood_process.php" method="POST">
            <label for="blood_type" class="content">Blood Type:</label>
            <input type="text" id="blood_type" name="blood_type" required><br>
            

            <button type="submit">Add</button>
        </form>
        Click <a href="index.php">here</a> if added all the info.
    </div>
</main>

<footer>
    <p>&copy; Life Source Blood Bank</p>
</footer>
</body>
</html>