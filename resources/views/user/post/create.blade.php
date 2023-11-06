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
                <!-- <label class="form-label" for="form3Example3">Title:</label></br>
                <input class="w-100" /></br>
                <label class="form-label mt-3" for="form3Example3">Content:</label></br>
                <textarea class="w-100" rows="5"></textarea></br>
                <label class="form-label mt-3" for="form3Example3">Media:</label>
                <input type="file"></br>
                <div class="justify-content-center d-flex">
                    <button class="btn btn-primary mt-3">Create</button>
                </div> -->
                <form method="POST" action="/post/tweets" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="tweet" placeholder="What's happening?">
                    <input class="form-control mt-3" type="file" name='media'>
                    <button type="submit">Tweet</button>
                </form>
            </div>

        </div>
    </div>
@endsection
