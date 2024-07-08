<div class="adminGallerymainDiv">
    <div class="adminGalleryInDiv">
        <h2>{{ __('messages.adminGaleryH2') }}</h2>

        @if(session('success'))
            <p style="color:green;">{{ session('success') }}</p>
        @endif

        <form action="{{ route('image.upload.post') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" accept="image/*">
            <button type="submit">{{ __('messages.adminGaleryUpload') }}</button>
        </form>
    </div>
</div>