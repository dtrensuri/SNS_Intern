@extends('layouts.user')
@section('content')
    <div class="main-content">
        <div class="container p-4">
            <header class="p-2">
                <h3 style="font-weight: 600">作成</h3>
            </header>
            <div class="select-platform col-2">
                <div class="platform-box">
                    <select name="select-platform" id="select-platform" class="p-2 w-100">
                        <option value="instagram">Instagram</option>
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                    </select>
                </div>
            </div>
            <div class="table-data-post">
                <form method="POST" action="/post/tweets" enctype="multipart/form-data">
                    @csrf
                    <label class="form-label" for="form3Example3">Content:</label></br>
                    <textarea type="text" name="tweet" rows="5" class="w-100" placeholder="What do you think?"></textarea>
                    <label class="form-label mt-3" for="form3Example3">Media:</label>
                    <input class="form-control" type="file" name='media'>
                    <button type="submit" class="mt-3">Tweet</button>
                </form>
            </div>

        </div>
    </div>
@endsection
