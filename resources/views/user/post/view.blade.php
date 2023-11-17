@extends('layouts.user')
@section('content')
    <div class="main-content">
        <div class="container pt-2">
            <header class="pb-1">
                <h4 style="font-weight: 600">一覧</h4>
            </header>
            <div class="row d-flex align-items-center justify-content-between">
                <div class="select-platform col-2">
                    <div class="platform-box">
                        <select name="select-platform" id="select-platform" class="p-2 w-100" title="Select platform">
                            <option value="instagram">Instagram</option>
                            <option value="facebook">Facebook</option>
                            <option value="twitter">Twitter</option>
                        </select>
                    </div>
                </div>
                <div class="refresh-btn col-1">
                    <button type="button" class="btn btn-outline-primary" onclick="refreshData()">
                        <div class="refresh-icon " id = "refresh-icon">
                            <i class="bi bi-arrow-repeat "></i>
                        </div>
                    </button>
                </div>
            </div>
            <div class="table-data-post">
                <table id="datatable" class="table table-hover datatable">
                    <thead>
                        <tr>
                            <th scope="col">公開日時</th>
                            <th scope="col">投稿内容</th>
                            <th scope="col">インプ</th>
                            <th scope="col">リーチ</th>
                            <th scope="col">いいね</th>
                            <th scope="col">コメント</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @if(isset($data) && count($data) > 0)
                            @foreach($data as $item)
                                <tr>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->content }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="2">No data available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                {{ view('component.loading') }}
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const selectPlatform = $("#select-platform");
        const tableBody = $("#table-body");
        const loadingElement = $("#loading");
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        function refreshData() {
            return view('user.post.view-post');
        }

        function showLoading() {
            if (!loadingElement.hasClass("loading")) {
                loadingElement.addClass("loading");
            }
        }

        function hideLoading() {
            loadingElement.removeClass('loading');
        }

        $(document).ready(function() {

            selectPlatform.change(async function() {
                const selectedPlatform = selectPlatform.val();
                showLoading();
                tableBody.html('');
                fetchUrl(selectedPlatform);
            });

        });
    </script>
@endpush
