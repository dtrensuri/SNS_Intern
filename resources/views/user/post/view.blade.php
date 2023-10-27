@extends('layouts.user')
@section('content')
    <div class="main-content">
        <div class="container p-4">
            <header class="p-2">
                <h3 style="font-weight: 600">一覧</h3>
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
                    <tbody>
                        <tr>
                            <td>2023/10/16</td>
                            <td>
                                <ul>
                                    <li> キャンペーン実施中！! </li>
                                    <li> キャンペーン実施中！！</li>
                                    <li> キャンペーン実施中！！</li>
                                </ul>
                            </td>
                            <td>
                                20,000
                            </td>
                            <td>
                                200
                            </td>
                            <td>
                                100
                            </td>
                            <td>
                                50
                            </td>
                        </tr>
                        <tr>
                            <td>2023/10/16</td>
                            <td>
                                <ul>
                                    <li> キャンペーン実施中！! </li>
                                    <li> キャンペーン実施中！！</li>
                                    <li> キャンペーン実施中！！</li>
                                </ul>
                            </td>
                            <td>
                                20,000
                            </td>
                            <td>
                                200
                            </td>
                            <td>
                                100
                            </td>
                            <td>
                                50
                            </td>
                        </tr>
                        <tr>
                            <td>2023/10/16</td>
                            <td>
                                <ul>
                                    <li> キャンペーン実施中！! </li>
                                    <li> キャンペーン実施中！！</li>
                                    <li> キャンペーン実施中！！</li>
                                </ul>
                            </td>
                            <td>
                                20,000
                            </td>
                            <td>
                                200
                            </td>
                            <td>
                                100
                            </td>
                            <td>
                                50
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
