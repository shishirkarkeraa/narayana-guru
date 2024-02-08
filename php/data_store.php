<?php require '../php/session.php'; ?>
<?php require '../php/activity.php'; ?>
<?php require '../php/adminheader.php'; ?>
<div class="blankbord">
    <form action="../php/process_data_store.php" method="post" enctype="multipart/form-data">
            <label for="file">Select files to upload:</label>
            <input type="file" name="files[]" id="files" multiple accept=".pdf, .doc, .xls, .txt, .jpg, .png, .ppt, .mp4, .mp3" required>
            <div class="submitdiv"> <input type="submit" id="submit" value="Upload"></div>
        </form>

        <script>
            document.querySelector('form').addEventListener('submit', function() {
                alert('Uploading files. Please wait...');
            });
        </script>
        <?php
include '../php/db_connection.php';

// Fetch file information from the database
$query = "SELECT id, filename, filetype, filepath FROM datastore";
$result = $conn->query($query);

// Check if there are any records
if ($result->num_rows > 0) {
    $files = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $files = [];
}

// Close the database connection
$conn->close();
?>
<h2>Files Information</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Filename</th>
                <th>Filetype</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($files as $file): ?>
                <tr>
                    <td><?php echo $file['filename']; ?></td>
                    <td><?php echo $file['filetype']; ?></td>
                    <td>
                        <a href="../php/view.php?id=<?php echo $file['id']; ?>" target="_blank">View</a>
                        <a href="../php/delete.php?id=<?php echo $file['id']; ?>" onclick="return confirm('Are you sure you want to delete this file?')">Delete</a>
                        <a href="../php/download.php?id=<?php echo $file['id']; ?>">Download</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require '../php/footer.php'; ?>
