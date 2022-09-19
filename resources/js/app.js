import './bootstrap';

// Add author modal
document.getElementById("addAuthorBtn").onclick = function() {
  document.getElementById("addAuthorModal").style.display = "block";
}
document.getElementsByClassName("close")[0].onclick = function() {
  document.getElementById("addAuthorModal").style.display = "none";
}
window.onclick = function(event) {
  if (event.target == document.getElementById("addAuthorModal")) {
    document.getElementById("addAuthorModal").style.display = "none";
  }
}

// Edit Author modal
document.getElementsByClassName("close")[1].onclick = function() {
  document.getElementById("editAuthorModal").style.display = "none";
}
window.onclick = function(event) {
  if (event.target == document.getElementById("editAuthorModal")) {
    document.getElementById("editAuthorModal").style.display = "none";
  }
}

// Add book modal
document.getElementById("addBookBtn").onclick = function() {
  document.getElementById("addBookModal").style.display = "block";
}
document.getElementsByClassName("close")[2].onclick = function() {
  document.getElementById("addBookModal").style.display = "none";
}
window.onclick = function(event) {
  if (event.target == document.getElementById("addBookModal")) {
    document.getElementById("addBookModal").style.display = "none";
  }
}

// Edit Author modal
document.getElementsByClassName("close")[3].onclick = function() {
  document.getElementById("editBookModal").style.display = "none";
}
window.onclick = function(event) {
  if (event.target == document.getElementById("editBookModal")) {
    document.getElementById("editBookModal").style.display = "none";
  }
}

async function doRequest( data, url, method ) {
  let res = await fetch(url, {
      method: method,
      headers: {
          'Content-Type': 'application/json',
      },
      body: data,
  });
  if (res.ok) {
    let ret = await res.json();
    return ret;
  } else {
      return `HTTP error: ${res.status}`;
  }
}

document.addEventListener('DOMContentLoaded', function(){
  const addAuthorForm = document.getElementById('addAuthorForm');
  const editAuthorForm = document.getElementById('editAuthorForm');
  const deleteAuthorBtns = document.getElementsByClassName('delete-author-btn');
  const editAuthorBtns = document.getElementsByClassName('edit-author-btn');
  
  const addBookForm = document.getElementById('addBookForm');
  const editBookForm = document.getElementById('editBookForm');
  const deleteBookBtns = document.getElementsByClassName('delete-book-btn');
  const editBookBtns = document.getElementsByClassName('edit-book-btn');
  
  // add author
  addAuthorForm.addEventListener('submit', function(e) {
    e.preventDefault();
    var data = JSON.stringify({
      'name': document.getElementById('addAuthorNameInput').value
    });
    var url = this.action;
    doRequest(data, url, 'POST').then(result => {
      if(result.status == "error") {
        document.getElementById('addAuthorResponse').textContent = result.message;
      } else if (result.status == "success") {
        window.location.replace("/dashboard");
      } else {
        alert('u broke me :0');
      }
    })
  });

  // edit author
  editAuthorForm.addEventListener('submit', function(e) {
    e.preventDefault();
    var data = JSON.stringify({
      'name': document.getElementById('editAuthorNameInput').value
    });
    var url = this.action + "/" + document.getElementById('editAuthorIdInput').value;
    doRequest(data, url, 'PUT').then(result => {
      if(result.status == "error") {
        document.getElementById('editAuthorResponse').textContent = result.message;
      } else if (result.status == "success") {
        window.location.replace("/dashboard");
      } else {
        alert('u broke me :0');
      }
    })
  });

  // delete author
  for (var i = 0; i < deleteAuthorBtns.length; i++) {
    deleteAuthorBtns[i].addEventListener('click', function() {
      var authorId = this.getAttribute("data-author-id");
      var url = "/api/v1/authors/"+authorId;
      doRequest(null, url, 'DELETE').then(result => {
        alert(result.message);
        if (result.status == "success") {
          window.location.replace("/dashboard");
        }
      })
    }, false);
  }

  // open edit author modal
  for (var i = 0; i < editAuthorBtns.length; i++) {
    editAuthorBtns[i].addEventListener('click', function() {
      var authorId = this.getAttribute("data-author-id");
      var authorName = this.getAttribute("data-author-name");
      document.getElementById('editAuthorNameInput').value = authorName;
      document.getElementById('editAuthorIdInput').value = authorId;
      document.getElementById("editAuthorModal").style.display = "block";
    }, false);
  }
  
  // add book
  addBookForm.addEventListener('submit', function(e) {
    e.preventDefault();
    var data = JSON.stringify({
      'title': document.getElementById('addBookTitleInput').value,
      'cover': document.getElementById('addBookCoverInput').value,
      'name': document.getElementById('addBookAuthorNameInput').value,
    });
    var url = this.action;
    doRequest(data, url, 'POST').then(result => {
      console.log(result);
      if(result.status == "error") {
        document.getElementById('addBookResponse').textContent = result.message;
      } else if (result.status == "success") {
        window.location.replace("/dashboard");
      } else {
        alert('u broke me :0');
      }
    })
  });

  // edit book
  editBookForm.addEventListener('submit', function(e) {
    e.preventDefault();
    var data = JSON.stringify({
      'title': document.getElementById('editBookTitleInput').value,
      'cover': document.getElementById('editBookCoverInput').value,
      'name': document.getElementById('editBookAuthorNameInput').value,
    });
    var url = this.action + "/" + document.getElementById('editBookIdInput').value;
    doRequest(data, url, 'PUT').then(result => {
      if(result.status == "error") {
        document.getElementById('editBookResponse').textContent = result.message;
      } else if (result.status == "success") {
        window.location.replace("/dashboard");
      } else {
        alert('u broke me :0');
      }
    })
  });

  // delete book
  for (var i = 0; i < deleteBookBtns.length; i++) {
    deleteBookBtns[i].addEventListener('click', function() {
      var bookId = this.getAttribute("data-book-id");
      var url = "/api/v1/books/"+bookId;
      doRequest(null, url, 'DELETE').then(result => {
        alert(result.message);
        if (result.status == "success") {
          window.location.replace("/dashboard");
        }
      })
    }, false);
  }

  // open edit book modal
  for (var i = 0; i < editBookBtns.length; i++) {
    editBookBtns[i].addEventListener('click', function() {
      var bookId = this.getAttribute("data-book-id");
      var bookAuthor = this.getAttribute("data-book-author");
      var bookTitle = this.getAttribute("data-book-title");
      var bookCover = this.getAttribute("data-book-cover");
      document.getElementById('editBookIdInput').value = bookId;
      document.getElementById('editBookTitleInput').value = bookTitle;
      document.getElementById('editBookAuthorNameInput').value = bookAuthor;
      document.getElementById('editBookCoverInput').value = bookCover;
      document.getElementById("editBookModal").style.display = "block";
    }, false);
  }

});