@extends('pages.base')

@section('content')


    <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Title</th>
                    <th>Description</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach($courses as $course):?>
                    <tr>
                        <td>{{$course->id}}</td>
                        <td>{{$course->trainor_user_name}}</td>
                        <td>{{$course->title}}</td>
                        <td>{{$course->description}}</td>
                        
                    </tr>
                    <?php endforeach;?>
            </tbody>
        </table>
        
@endsection