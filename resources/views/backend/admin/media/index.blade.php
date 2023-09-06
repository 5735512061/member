@extends("backend/layouts/admin/template")
<style>
    .media h4 {
        color: #fff;
        border-bottom: 2px solid #eeeeee;
        padding-bottom: 15px;
    }

    .media h3 {
        color: #a7a7a7e1;
    }

    .media p {
        font-size: 14px;
    }

    .media span {
        font-size: 14px;
        color: red;
        font-weight: bold;
    }
</style>
@section("content")
<div class="container-fluid py-4">
    <div class="media">
        <h4>Media</h4>
    </div>
    <a href="{{ url('/upload-slide-image') }}" class="btn btn-success mt-3" type="submit">รูปภาพสไลด์หน้าหลัก</a>
    <a href="{{ url('/upload-article-image') }}" class="btn btn-secondary mt-3" type="submit">รูปภาพเนื้อหาบทความ</a>
</div>
@endsection