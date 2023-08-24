@extends('backend/layouts/admin/template')
<style>
    .partner h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }

    .partner h3 {
        color: #a7a7a7e1;
    }

    .partner p {
        font-size: 14px;
    }

    .partner span {
        font-size: 20px;
        color: red;
        font-weight: bold;
    }
</style>
@section('content')
    <div class="container-fluid py-4">
        <div class="partner">
            <h4>บทความและข่าวสาร</h4>
        </div>
        <a href="{{ url('/create-article') }}" class="btn btn-success mt-5" type="submit"><i class="fa fa-plus-circle"
                aria-hidden="true"></i> สร้างบทความ</a>
    </div>
    <div class="container-fluid py-4">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if (Session::has('alert-' . $msg))
                    <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                @endif
            @endforeach
        </div>
        <div class="reward">
            <div class="row">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">ข้อมูลบทความและข่าวสาร</h6>
                        </div>
                        <div class="card-body p-3">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr style="text-align: center;">
                                            <th>#</th>
                                            <th>หัวข้อ</th>
                                            <th>ประเภทบทความ</th>
                                            <th>เนื้อหาบทความ</th>
                                            <th>รูปภาพ</th>
                                            <th>สถานะ</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody class="list">
                                        @foreach ($articles as $article => $value)
                                            <tr style="text-align:center;">
                                                <td>{{ $NUM_PAGE * ($page - 1) + $article + 1 }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>{{ $value->type }}</td>
                                                <td><a href="{{ url('/partner-promotion') }}/{{ $value->id }}"><i
                                                            class="fa fa-folder-o" style="color: green;"></i></a></td>
                                                <td><a data-bs-toggle="modal" data-bs-target="#image{{$value->id}}" data-bs-toggle="modal" data-bs-target="#image{{$value->id}}"><i
                                                            class="fa fa-picture-o" style="color: green;"></i></a></td>
                                                <td>{{ $value->status }}</td>
                                                <td><a href="{{ url('/article-edit') }}/{{ $value->id }}"><i
                                                            class="fa fa-pencil-square-o" style="color: green;"></i></a>
                                                    <a href="{{ url('/delete-article') }}/{{ $value->id }}"><i
                                                            class="fa fa-trash-o" style="color: red;"></i></a>
                                                </td>
                                            </tr>
                                            <!-- Modal -->
                                            <div class="modal fade" id="image{{ $value->id }}"
                                                data-bs-backdrop="static" tabindex="-1">
                                                <div class="modal-dialog">
                                                    <form action="{{ url('addpoint') }}" method="POST"
                                                        enctype="multipart/form-data" class="modal-content">@csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="addpointTitle">เพิ่มพอยท์</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-outline-secondary"
                                                                data-bs-dismiss="modal"
                                                                style="font-family:'Prompt';">ปิด</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                style="font-family:'Prompt';">เพิ่มพอยท์</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
