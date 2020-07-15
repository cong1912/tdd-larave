<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
 <h1>showw</h1>
 <li>{{$project->title}}</li>
 <li>{{$project->description}}</li>

    @foreach($project->tasks as $tasks )
        <div class="card mb-3">{{$tasks->body}}</div>
        
       
    @endforeach
    <form action="{{$project->path() . '/tasks'}}" method="POST">
            @csrf
            <input placeholder= "add a new tasks..." class="w-full" name="body">
        </form>
</body>
</html>
