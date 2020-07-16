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
        <div class="card mb-3">
            <form method="POST" action="{{ $tasks->path()}}">
            @method('PATCH')
            @csrf
           <input name="body" value="{{$tasks->body}}" class="w-full">
           <input name="completed" type="checkbox" onChange="this.form.submit()">
               
            </form>
            </div>
       
    @endforeach
    <form action="{{$project->path() . '/tasks'}}" method="POST">
            @csrf
            <input placeholder= "add a new tasks..." class="w-full" name="body">
        </form>
    <form action="{{$project->path()}}" method="POST">

        @csrf
        @method('PATCH')

        <textarea name="notes" placeholder="anything you want to make a note of?">{{$project->notes}}</textarea>

        <button class="button" type="submit">Save</button>
    </form>
</body>
</html>
