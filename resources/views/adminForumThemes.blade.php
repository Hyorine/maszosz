<div class="adminUser-table">
    <h2>Forum témák</h2>
        @if(session('NewCategoryAddSuccess'))
            <p style="color:green;">{{ session('NewCategoryAddSuccess') }}</p>
        @endif
        @if(session('NewCategoryAddError'))
            <p style="color:red;">{{ session('NewCategoryAddError') }}</p>
        @endif
    <div class="table-fixed-div">
        <table>
            <thead>
                <th>Neve</th>
                <th>állapot</th>
            </thead>
            <tbody>
                @foreach($Categorys as $Category)
                    <tr>
                        <td>{{$Category->name}}</td>
                        <td>
                            <form id="category-form" action="{{ route('adminChange') }}" method="POST">
                                @csrf
                                <input type="hidden" name="category_id" value="{{$Category->id}}">
                                <input type="hidden" id="userOperation" name="userOperation" value="5">
                                <input type="range" min="0" max="1" value="{{$Category->active}}" class="active-range" name="active">
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <br/>
    <div>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createForumCategoryModal">{{ __('messages.adminCategoryCreateNewButton') }}</button>
    </div>
</div>

<!-- Bootstrap Modal for creating a new rank -->
<div class="modal fade" id="createForumCategoryModal" tabindex="-1" role="dialog" aria-labelledby="createRankModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-header">
                <h5 class="modal-title" id="createRankModalLabel">{{ __('messages.adminCategoryTitle') }}</h5>
            </div>
            <div class="modal-body">
                <!-- Form for creating a new rank -->
                <form id="createRankForm" method="post" action="{{ route('adminChange') }}">
                @csrf
                <input type="hidden" id="userOperation" name="userOperation" value="6">
                    <div class="form-group">
                        <label for="categoryName">{{ __('messages.adminCategoryname') }}</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName">
                    </div>
                    <!-- Submit button for the form -->
                    <button type="submit" class="btn btn-primary" id="submitRankFormBtn">{{ __('messages.CreationBUttonName') }}</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('messages.CloseButtonName') }}</button>
            </div>
        </div>
    </div>
</div>


<script>
     $(document).ready(function() {
        $('.active-range').change(function() {
            var formData = $(this).closest('form').serialize(); // Serialize form data
            var url = $(this).closest('form').attr('action'); // Get form action URL

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                success: function(response) {

                },
                error: function(xhr, status, error) {
                   
                }
            });
        });
    });
</script>