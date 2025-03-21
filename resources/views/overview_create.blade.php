@include('includes.header')

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="container">
    <h2>Create Overview Section</h2>
    <form action="{{ route('overview.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Text</label>
            <textarea id="editor" name="content" class="form-control" rows="10"></textarea>
        </div>
         <div class="mb-3">
            <label class="form-label">Upload Images & Videos</label>
            <input type="file" class="form-control" name="media" multiple>
        </div>
        <div class="mb-3">
            <label class="form-label">Page Type</label>
            <select class="form-control" name="page_type">
                <option value="kavach">Kavach</option>
                <option value="Lte">Lte</option>
                <option value="5G">5G</option>
            </select>
            
        </div>
        <button type="submit" class="btn" style="background-color:#003366;color:white;">Save Overview</button>
    </form>
</div>
</div>

@include('includes.footer')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    setTimeout(function () {
        let alert = document.querySelector(".alert");
        if (alert) {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        }
    }, 3000); // Message disappears after 3 seconds
</script>
