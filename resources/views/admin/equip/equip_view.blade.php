@extends('admin.layouts.master')

@section('contents')

<h1>djfnjsndfn</h1>
<form action="/import" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" accept=".xlsx">
    <button type="submit">Import</button>
</form>
@endsection
