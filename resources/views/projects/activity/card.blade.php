
<div class="mt-3">
    <ul>
        @foreach ($project->activity as $activity)
            <li>
                @include("projects.activity.{$activity->description}")
                {{$activity->created_at->diffForHumans(null, true)}}
            </li>
        @endforeach

    </ul>
    @can('manage',$project)
    <footer>
        <form action="{{$project->path()}}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit">Delete</button>
        </form>
    </footer>
    @endcan
</div>
