<div class="admin-galery-delet-div">
        <h1>{{ __('messages.admingaleryDeleth1') }}</h1>
        @if(session('imageDeletsuccess'))
            <p style="color:green;">{{ session('imageDeletsuccess') }}</p>
        @endif
        @if(session('imageDeleterror'))
            <p style="color:red;">{{ session('imageDeleterror') }}</p>
        @endif
    <div class="table-fixed-div">
        <table class="table table-bordered tabel-fixed">
            <thead >
                <tr >
                    <th>{{ __('messages.admingaleryDeletneve') }}</th>
                    <th>{{ __('messages.admingaleryDelettorol') }}</th>
                </tr>
            </thead >
            <tbody>
                @foreach($imageNames as $imageName)
                    <tr>
                        <td><a href="{{ asset(str_replace(public_path(), '', $imageName)) }}" target="_blank">{{ asset(str_replace(public_path(), '', $imageName)) }}</a></td>
                        <td>
                            <form action="{{ route('delete.image') }}" method="post" onsubmit="return confirm('Are you sure?')">
                                @csrf
                                <input type="hidden" name="imageName" value="{{ basename($imageName) }}">
                                <button type="submit">{{ __('messages.admingaleryDeletGomb') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>