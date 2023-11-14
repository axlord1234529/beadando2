<h2>
    Fake Forum
</h2>
<?php 
?>
<div id="posts"></div>
    
    <form action="" id="newPostForm">
        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>
        <br>
        <label for="content">Content:</label>
        <textarea id="content" name="content" required></textarea>
        <br>
    </form>
    <button type="submit" onclick="addNewPost()">Add Post</button>
    <script src="<?php echo SITE_ROOT?>scripts/forum.js"></script>