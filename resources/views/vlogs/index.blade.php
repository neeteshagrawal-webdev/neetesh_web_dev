@include('includes.header')

     

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
      
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* Custom styles for the button and modal */
    .start-post-btn {
        background-color: #f3f3f3;
        border: 1px solid #ccc;
        border-radius: 25px;
        padding: 10px 20px;
        width: 100%;
        text-align: left;
        cursor: pointer;
    }

    .start-post-btn:hover {
        background-color: #ebebeb;
    }

    .custom-modal {
        max-width: 600px;
        margin: auto;
    }

    .modal-header {
        border-bottom: none;
        padding-bottom: 0;
    }

    .modal-footer {
        border-top: none;
        justify-content: space-between;
        padding-top: 0;
    }

    .post-input {
        border: none;
        width: 100%;
        resize: none;
        font-size: 16px;
    }

    .post-input:focus {
        outline: none;
        box-shadow: none;
    }

    .modal-icons {
        display: flex;
        align-items: center;
        gap: 15px;
        font-size: 18px;
        margin-top: 10px;
        cursor: pointer;
        position: relative;
    }

    .post-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 20px;
        border-radius: 20px;
        transition: background-color 0.3s ease;
    }

    .post-btn:hover {
        background-color: #0056b3;
        color: #fff;
    }

    .post-btn:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    input[type="file"] {
        display: none;
    }

    /* Styles for the posted card */
    .posted-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 15px;
        margin-top: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .posted-card .header {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .posted-card .header img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
    }

    .posted-card .header .user-details {
        display: flex;
        flex-direction: column;
    }

    .posted-card .content img {
        max-width: 100%;
        border-radius: 8px;
        margin-top: 15px;
    }

    .posted-card .footer {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
        font-size: 14px;
        color: #555;
    }

    .posted-card .footer .actions i {
        margin-right: 10px;
        cursor: pointer;
    }

    .posted-card .footer .actions i:hover {
        color: #007bff;
    }
</style>

<!-- Start a Post Button -->

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="container-fluid" style="max-width: 600px; margin: auto;">
    <div class="d-flex align-items-center mb-3">
        <img src="https://www.ezsmartmall.com/static/ezsmart/assets/admin_css/img/undraw_profile.svg" alt="Profile" class="profile-img me-3" width="50">
        <button class="start-post-btn" data-bs-toggle="modal" data-bs-target="#postModal">
            Start a post
        </button>
    </div>

    <div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
        <div class="modal-dialog custom-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="postModalLabel">Post to Anyone</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                <form action="{{ route('vlogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://www.ezsmartmall.com/static/ezsmart/assets/admin_css/img/undraw_profile.svg" alt="Profile" class="profile-img me-3" width="50">
                        <h6 class="m-0">{{ auth()->user()->name }}
                        </h6>
                    </div>

                    <div class="mb-3">
    <label class="form-label">Title:</label>
    <input type="text" name="title" class="form-control" placeholder="Enter title" required>
</div>
                    <textarea id="postText" class="post-input" rows="4" name="description" placeholder="What do you want to talk about?"></textarea>
                    <div class="modal-icons mt-3">
                        <!-- Add Media Section -->
                        <div class="d-flex align-items-center mb-2">
                            <label for="imageUpload" class="d-flex align-items-center" style="cursor: pointer;">
                                <i class="bi bi-image me-2" style="font-size: 20px;"></i>
                                <span> Images</span>
                            </label>
                            <input id="imageUpload" type="file" name="image" accept="image/*" multiple>
                        </div>
                        <!-- Add Document Section -->
                        <!-- <div class="d-flex align-items-center mb-2">
                            <label for="documentUpload" class="d-flex align-items-center" style="cursor: pointer;">
                                <i class="bi bi-file-earmark-text me-2" style="font-size: 20px;"></i>
                                <span> Document</span>
                            </label>
                            <input id="documentUpload" type="file" accept=".pdf,.doc,.docx,.txt" multiple>
                        </div> -->
                        <!-- Add Video Section -->
                        <!-- <div class="d-flex align-items-center mb-2">
                            <label for="videoUpload" class="d-flex align-items-center" style="cursor: pointer;">
                                <i class="bi bi-play-circle me-2" style="font-size: 20px;"></i>
                                <span> Video</span>
                            </label>
                            <input id="videoUpload" type="file" accept="video/*" multiple>
                        </div> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="postButton" type="submit" class="btn post-btn" disabled>add Post</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
@foreach($vlogs as $vlog)
<div class="posted-card mx-auto" style="max-width: 600px;">
    <div class="header d-flex justify-content-between align-items-center mb-3">
        <!-- Profile Section -->
        <div class="d-flex align-items-center">
            <img src="https://www.ezsmartmall.com/static/ezsmart/assets/admin_css/img/undraw_profile.svg" alt="Profile" class="me-3" style="width: 50px; height: 50px; border-radius: 50%;">
            <div class="user-details">
                <strong>{{ $vlog->user->name ?? 'Unknown' }}</strong>
                <small class="text-muted d-block">{{ $vlog->created_at->diffForHumans() ?? '' }}</small>

            </div>
        </div>
        <!-- Three-Dot Menu -->
       <!-- Dropdown Menu -->
<div class="dropdown">
    <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots"></i>
    </button>
    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
       
                <!-- <li><a class="dropdown-item" href="#" onclick="copyLink()">Copy link to post</a></li> -->
                @if(auth()->id() === $vlog->user_id)
                <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteVlogModal" onclick="setDeleteForm('{{ route('vlogs.destroy', $vlog->id) }}')">
                        Delete this post
                    </a>
                </li>
            @endif
            
    </ul>
</div>
    </div>
    <div class="content">
        <h4>{{ $vlog->title }}</h4>
        <p>{{ $vlog->description }}</p>
        @if($vlog->image)
    <img src="{{ asset('storage/'.$vlog->image) }}" class="img-fluid" alt="Vlog Image">
@endif

    </div>
    <div class="footer mt-3">
        <!-- Row 1: Stats -->
        <div class="row stats text-center mb-3" style="width: 100%;">
            <div class="col-4">
                <i class="bi bi-hand-thumbs-up text-primary d-block"></i>
                <span><span id="likeCount{{ $vlog->id }}">{{ $vlog->like }}</span></span>
            </div>
            <div class="col-4">
                <i class="bi bi-hand-thumbs-down text-primary d-block"></i>
                <span><span id="dislikeCount{{ $vlog->id }}">{{ $vlog->dislike }}</span></span>
            </div>
            

            <div class="col-4">
                <i class="bi bi-chat text-secondary d-block"></i>
                <span>{{$vlog->comments->count()}} comments</span>
            </div>
            
        </div>
        <hr>
    </div>

<!-- Footer with Like, Comment, Share -->
<div class="footer mt-3">
    <div class="row actions text-center" style="width: 100%;">
        @php
    $userLike = App\Models\Like::where('user_id', auth()->id())->where('vlog_id', $vlog->id)->first();
@endphp

<div class="col-4">
    <button onclick="handleLikeDislike('{{ json_encode($vlog->id) }}', 'like', this)" 
            data-id="{{ $vlog->id }}" data-type="like"
            class="btn d-flex align-items-center justify-content-center w-100 
                   {{ $userLike && $userLike->type == 'like' ? 'btn-primary text-dark' : 'btn-light' }}">
        <i class="bi {{ $userLike && $userLike->type == 'like' ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' }} me-2"></i> 
        {{ $userLike && $userLike->type == 'like' ? 'Liked' : 'Like' }}
        <!-- <span id="likeCount{{ $vlog->id }}" class="ms-2">{{ $vlog->like }}</span> -->
    </button>
</div>

<div class="col-4">
    <button onclick="handleLikeDislike('{{ json_encode($vlog->id) }}', 'dislike', this)" 
            data-id="{{ $vlog->id }}" data-type="dislike"
            class="btn d-flex align-items-center justify-content-center w-100 
                   {{ $userLike && $userLike->type == 'dislike' ? 'btn-danger text-dark' : 'btn-light' }}">
        <i class="bi {{ $userLike && $userLike->type == 'dislike' ? 'bi-hand-thumbs-down-fill' : 'bi-hand-thumbs-down' }} me-2"></i> 
        {{ $userLike && $userLike->type == 'dislike' ? 'Disliked' : 'Dislike' }}
        <!-- <span id="dislikeCount{{ $vlog->id }}" class="ms-2">{{ $vlog->dislike }}</span> -->
    </button>
</div>

        
        
        
        
        
        
        <div class="col-4">
            <button id="commentButton" class="btn btn-light d-flex align-items-center justify-content-center w-100">
                <i class="bi bi-chat me-2"></i> Comment
            </button>
        </div>
       
       
    </div>
</div>

<!-- Comments Section (Last Footer) -->
<!-- Comments Section (Bootstrap Styled) -->
<div id="commentsFooter" class="footer mt-3 w-100">
    <div class="card shadow mt-3" id="commentsSection" style="display: none; width: 100%;">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Comments</h5>
            
        </div>
        <div class="card-body">
            <input type="hidden" id="vlogId" value="{{ $vlog->id }}">

            <!-- Comment Input Field -->
            <div class="mb-3">
                <textarea id="newComment" class="form-control border rounded shadow-sm" rows="2" placeholder="Write a comment..."></textarea>
            </div>
            <button id="addCommentButton" class="btn btn-primary btn-sm">Add Comment</button>

            <!-- Comments List -->
            <div id="commentsList" class="mt-3">
                @if($vlog->comments->count() > 0)
                    @foreach($vlog->comments as $comment)
                        <div class="card shadow-sm p-2 mb-2 border rounded" data-id="{{ $comment->id }}">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <div>
                                    <strong class="me-2">{{ $comment->user->name }}</strong>
                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                </div>
                            
                                @if(auth()->id() === $comment->user_id)
                                    <!-- <button  style="padding: 5px;font-size: 11px;" class="btn btn-light btn-sm delete-comment" data-id="{{ $comment->id }}"> -->
                                        <i  class="fas fa-trash-alt delete-comment" data-id="{{ $comment->id }}" style="color: #000;"></i>
                                    <!-- </button> -->
                                @endif
                            </div>
                            
                            <p class="mb-1">{{ $comment->comment }}</p>

                            
                        </div>
                    @endforeach
                @else
                    <p class="text-muted text-center" id="noComments">No comments yet. Be the first to comment!</p>
                @endif
            </div>
        </div>
    </div>
</div>



</div>
@endforeach


<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteVlogModal" tabindex="-1" aria-labelledby="deleteVlogModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteVlogModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this vlog? This action cannot be undone.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteVlogForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function setDeleteForm(actionUrl) {
        document.getElementById("deleteVlogForm").action = actionUrl;
    }
</script>


<script>function handleLikeDislike(vlogId, type, button) {
    const likeCountElement = document.getElementById(`likeCount${vlogId}`);
    const dislikeCountElement = document.getElementById(`dislikeCount${vlogId}`);
    const likeButton = document.querySelector(`button[data-id='${vlogId}'][data-type='like']`);
    const dislikeButton = document.querySelector(`button[data-id='${vlogId}'][data-type='dislike']`);

    if (!likeCountElement || !dislikeCountElement) {
        console.error(`Error: Count elements for vlog ID ${vlogId} not found.`);
        return;
    }

    const csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
    if (!csrfTokenMeta) {
        console.error("Error: CSRF token meta tag not found.");
        return;
    }

    const csrfToken = csrfTokenMeta.getAttribute("content");

    fetch(`/vlogs/${vlogId}/${type}`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrfToken
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "liked") {
            likeButton.classList.add("btn-primary", "text-dark");
            likeButton.innerHTML = `<i class="bi bi-hand-thumbs-up-fill me-2"></i> Liked`;
            likeCountElement.textContent = data.likes;

            // ✅ Dislike remove karein agar pehle present tha
            dislikeButton.classList.remove("btn-danger", "text-dark");
            dislikeButton.innerHTML = `<i class="bi bi-hand-thumbs-down me-2"></i> Dislike`;
            dislikeCountElement.textContent = data.dislikes;
        } else if (data.status === "disliked") {
            dislikeButton.classList.add("btn-danger", "text-dark");
            dislikeButton.innerHTML = `<i class="bi bi-hand-thumbs-down-fill me-2"></i> Disliked`;
            dislikeCountElement.textContent = data.dislikes;

            // ✅ Like remove karein agar pehle present tha
            likeButton.classList.remove("btn-primary", "text-dark");
            likeButton.innerHTML = `<i class="bi bi-hand-thumbs-up me-2"></i> Like`;
            likeCountElement.textContent = data.likes;
        } else {
            // ✅ Agar user ne same button dobara click kiya to remove karein
            button.classList.remove(type === "like" ? "btn-primary" : "btn-danger", "text-dark");
            button.innerHTML = `<i class="bi bi-hand-thumbs-${type} me-2"></i> ${type.charAt(0).toUpperCase() + type.slice(1)}`;
            if (type === "like") likeCountElement.textContent = data.likes;
            else dislikeCountElement.textContent = data.dislikes;
        }
    })
    .catch(error => console.error("Error:", error));
}

</script>





<script>
    const shareButton = document.getElementById("shareButton");

    // Share functionality
    shareButton.addEventListener("click", () => {
        const postLink = "https://example.com/post/123"; // Replace with the actual post URL
        const postText = "Check out this amazing post!";

        // Check if the Web Share API is supported
        if (navigator.share) {
            navigator.share({
                title: "Post Title",
                text: postText,
                url: postLink,
            })
                .then(() => console.log("Shared successfully"))
                .catch((error) => console.error("Error sharing:", error));
        } else {
            // If Web Share API is not supported, provide manual sharing links
            const encodedPostText = encodeURIComponent(postText);
            const encodedPostLink = encodeURIComponent(postLink);

            const whatsappUrl = `https://wa.me/?text=${encodedPostText} ${encodedPostLink}`;
            const instagramUrl = `https://www.instagram.com/direct/inbox/`;
            const copyToClipboard = async () => {
                try {
                    await navigator.clipboard.writeText(postLink);
                    alert("Post link copied to clipboard!");
                } catch (error) {
                    alert("Failed to copy link. Please try again.");
                }
            };

            // Ask the user how they want to share
            const shareOptions = `
                <div style="text-align: center;">
                    <a href="${whatsappUrl}" target="_blank" class="btn btn-success btn-sm mb-2">Share on WhatsApp</a><br>
                    <a href="${instagramUrl}" target="_blank" class="btn btn-danger btn-sm mb-2">Share on Instagram</a><br>
                    <button class="btn btn-primary btn-sm" onclick="(${copyToClipboard.toString()})()">Copy Link</button>
                </div>
            `;
            const shareModal = document.createElement("div");
            shareModal.innerHTML = `
                <div style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); display: flex; justify-content: center; align-items: center; z-index: 9999;">
                    <div style="background: white; padding: 20px; border-radius: 8px;">
                        <h5>Share This Post</h5>
                        ${shareOptions}
                        <button class="btn btn-secondary mt-3" onclick="this.parentNode.parentNode.remove()">Close</button>
                    </div>
                </div>
            `;
            document.body.appendChild(shareModal);
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const commentButton = document.getElementById("commentButton");
        const commentsSection = document.getElementById("commentsSection");
        const addCommentButton = document.getElementById("addCommentButton");
        const newComment = document.getElementById("newComment");
        const commentsList = document.getElementById("commentsList");
        const vlogId = document.getElementById("vlogId").value;

        // 📌 Toggle comments section visibility when clicking the comment button
        commentButton.addEventListener("click", function () {
            commentsSection.style.display = commentsSection.style.display === "none" || commentsSection.style.display === "" ? "block" : "none";
        });

        // 📌 Function to Add a New Comment (AJAX)
        addCommentButton.addEventListener("click", function () {
            const commentText = newComment.value.trim();

            if (commentText === "") {
                alert("Please write a comment before adding.");
                return;
            }

            fetch("{{ route('comments.store') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    vlog_id: vlogId,
                    comment: commentText
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // 📌 Create New Comment Element
                    const commentElement = document.createElement("div");
                    commentElement.className = "card shadow-sm p-2 mb-2 border rounded";
                    commentElement.dataset.id = data.comment.id;
                    commentElement.innerHTML = `
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <strong class="me-2">${data.comment.user_name}</strong>
                                <small class="text-muted">Just now</small>
                            </div>
                            
                                <i class="fas fa-trash-alt delete-comment" data-id="${data.comment.id}" ></i>
                            
                        </div>
                        <p class="mb-1">${data.comment.comment}</p>
                    `;

                    commentsList.appendChild(commentElement);
                    newComment.value = "";

                    // 📌 Remove "No Comments" message
                    const noCommentsMessage = document.getElementById("noComments");
                    if (noCommentsMessage) {
                        noCommentsMessage.remove();
                    }
                } else {
                    alert("Error: " + data.error);
                }
            })
            .catch(error => console.error("Error:", error));
        });

        // 📌 Function to Delete a Comment (AJAX)
        commentsList.addEventListener("click", function (e) {
            if (e.target.closest(".delete-comment")) {
                const deleteButton = e.target.closest(".delete-comment");
                const commentId = deleteButton.dataset.id;
                const commentElement = deleteButton.closest(".card");

                fetch(`/comments/${commentId}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (commentElement) {
                            commentElement.remove(); // ✅ Correctly removes comment div
                        }
                    } else {
                        alert("Error: " + data.error);
                    }
                })
                .catch(error => console.error("Error:", error));
            }
        });
    });
</script>

    

    <!-- function copyLink() {
        const postLink = "https://example.com/post/123";
        navigator.clipboard.writeText(postLink).then(() => alert("Link copied!"));
    } -->

   
</script>

<script>
    // Functionality to enable the "Post" button
    const postText = document.getElementById('postText');
    const imageUpload = document.getElementById('imageUpload');
    const documentUpload = document.getElementById('documentUpload');
    const videoUpload = document.getElementById('videoUpload');
    const postButton = document.getElementById('postButton');

    function checkInputs() {
        if (postText.value.trim() !== '' || imageUpload.files.length > 0 || documentUpload.files.length > 0 || videoUpload.files.length > 0) {
            postButton.disabled = false;
        } else {
            postButton.disabled = true;
        }
    }

    // Event Listeners
    postText.addEventListener('input', checkInputs);
    imageUpload.addEventListener('change', checkInputs);
    documentUpload.addEventListener('change', checkInputs);
    videoUpload.addEventListener('change', checkInputs);
</script>

                  
       

    
@include('includes.footer')