class Post {
    constructor(author, content) {
        this.author = author;
        this.content = content;
    }
}

class FakeForum {
    constructor() {
        this.posts = [];
    }

    async fetchPosts() {
        const response = await fetch('https://jsonplaceholder.typicode.com/posts');
        const postsData = await response.json();
        this.posts = postsData.map(postData => new Post(postData.title, postData.body));
    }

    displayPosts() {
        const postsContainer = document.getElementById('posts');
        postsContainer.innerHTML = '';

        this.posts.forEach(post => {
            const postElement = document.createElement('div');
            postElement.innerHTML = `<strong>${post.author}</strong>: ${post.content}
                <br><button onclick="editPost(${post.id})">Edit</button>
                <button onclick="forum.deletePost(${post.id})">Delete</button><hr>`;
            postsContainer.appendChild(postElement);
        });
    }

    async addPost(newPost) {
        const response = await fetch('https://jsonplaceholder.typicode.com/posts', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                title: newPost.author,
                body: newPost.content,
                userId: 1, // User ID for example purposes
            }),
        });

        console.log(response);
        const postData = await response.json();
        const addedPost = new Post(postData.title, postData.body);
        this.posts.push(addedPost);
        this.displayPosts();
    }

    async deletePost(postId) {
        await fetch(`https://jsonplaceholder.typicode.com/posts/${postId}`, {
            method: 'DELETE',
        });

        this.posts = this.posts.filter(post => post.id !== postId);
        this.displayPosts();
    }

    async getPost(postId) {
        const response = await fetch(`https://jsonplaceholder.typicode.com/posts/${postId}`);
        const postData = await response.json();
        return new Post(postData.title, postData.body);
    }

    async updatePost(postId, updatedPost) {
        await fetch(`https://jsonplaceholder.typicode.com/posts/${postId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                title: updatedPost.author,
                body: updatedPost.content,
                userId: 1, // User ID for example purposes
            }),
        });

        const index = this.posts.findIndex(post => post.id === postId);
        if (index !== -1) {
            this.posts[index] = updatedPost;
        }

        this.displayPosts();
    }
}

// Function to edit a post
async function editPost(postId) {
    const updatedAuthor = prompt('Enter the updated author:');
    const updatedContent = prompt('Enter the updated content:');

    if (updatedAuthor !== null && updatedContent !== null) {
        const updatedPost = new Post(updatedAuthor, updatedContent);
        await forum.updatePost(postId, updatedPost);
    }
}

// Create an instance of the FakeForum class
const forum = new FakeForum();

// Fetch posts and display them when the page loads
window.onload = async () => {
    await forum.fetchPosts();
    forum.displayPosts();
};

async function addNewPost() {
    const author = document.getElementById('author').value;
    const content = document.getElementById('content').value;
    const newPost = new Post(author, content);
    await forum.addPost(newPost);
    // Clear the form after adding the post
    document.getElementById('newPostForm').reset();
}
// Add new post form event listener
const newPostForm = document.getElementById('newPostForm');
newPostForm.addEventListener('submit', async function (e) {
    e.preventDefault();
    const author = document.getElementById('author').value;
    const content = document.getElementById('content').value;
    const newPost = new Post(author, content);
    await forum.addPost(newPost);
    // Clear the form after adding the post
    this.reset();
});